<?php

namespace JeffersonGoncalves\Filament\GdprDsar\Actions;

use Filament\Actions\Action;
use Filament\Actions\MountableAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action as TableAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use JeffersonGoncalves\Filament\GdprDsar\GdprDsarPlugin;
use JeffersonGoncalves\GdprDsar\DsarManager;
use JeffersonGoncalves\GdprDsar\Models\DataSubjectRequest;
use LogicException;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Row and view-page actions: each one is a thin call to laravel-gdpr-dsar's DsarManager.
 *
 * Filament 3 has separate table and page action classes: pass TableAction::class for the table.
 */
class DsarActions
{
    /**
     * @param  class-string<Action|TableAction>  $class
     * @return list<Action|TableAction>
     */
    public static function all(string $class = Action::class): array
    {
        return [static::verify($class), static::fulfil($class), static::complete($class), static::reject($class), static::extend($class), static::download($class)];
    }

    /**
     * @param  class-string<Action|TableAction>  $class
     */
    public static function verify(string $class = Action::class): Action|TableAction
    {
        return $class::make('verify')
            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.actions.verify.label'))
            ->icon('heroicon-o-identification')
            ->color('info')
            ->visible(fn (DataSubjectRequest $record): bool => $record->isOpen())
            ->modalDescription(__('filament-gdpr-dsar::filament-gdpr-dsar.actions.verify.description'))
            ->fillForm(fn (DataSubjectRequest $record): array => [
                'subject_type' => static::subjectClass($record),
                'subject_id' => $record->getAttribute('subject_id'),
            ])
            ->form([
                Select::make('subject_type')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.subject_type'))
                    ->options(fn (): array => collect(GdprDsarPlugin::get()->getSubjectModels())
                        ->mapWithKeys(fn (string $model): array => [$model => class_basename($model)])
                        ->all())
                    ->required(),
                TextInput::make('subject_id')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.subject_id'))
                    ->required(),
            ])
            ->action(function (DataSubjectRequest $record, array $data, MountableAction $action): void {
                $model = $data['subject_type'];

                // Only the listed models: never instantiate a class name taken from the request.
                $subject = in_array($model, GdprDsarPlugin::get()->getSubjectModels(), true)
                    ? $model::query()->find($data['subject_id'])
                    : null;

                if (! $subject instanceof Model) {
                    Notification::make()->danger()->title(__('filament-gdpr-dsar::filament-gdpr-dsar.actions.verify.not_found'))->send();
                    $action->halt();

                    return;
                }

                app(DsarManager::class)->verify($record, $subject);

                Notification::make()->success()->title(__('filament-gdpr-dsar::filament-gdpr-dsar.actions.verify.success'))->send();
            });
    }

    /**
     * @param  class-string<Action|TableAction>  $class
     */
    public static function fulfil(string $class = Action::class): Action|TableAction
    {
        return $class::make('fulfil')
            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.actions.fulfil.label'))
            ->icon('heroicon-o-play')
            ->color(fn (DataSubjectRequest $record): string => $record->type->value === 'erasure' ? 'danger' : 'success')
            ->visible(fn (DataSubjectRequest $record): bool => $record->isOpen() && $record->isVerified() && $record->type->isAutomatic())
            ->requiresConfirmation()
            ->modalDescription(fn (DataSubjectRequest $record): string => __('filament-gdpr-dsar::filament-gdpr-dsar.actions.fulfil.description.'.$record->type->value))
            ->form([
                Textarea::make('response')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.response')),
            ])
            ->action(function (DataSubjectRequest $record, array $data): void {
                static::attempt(fn () => app(DsarManager::class)->fulfil($record, $data['response'] ?? null), 'fulfil');
            });
    }

    /**
     * @param  class-string<Action|TableAction>  $class
     */
    public static function complete(string $class = Action::class): Action|TableAction
    {
        return $class::make('complete')
            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.actions.complete.label'))
            ->icon('heroicon-o-check-circle')
            ->color('success')
            ->visible(fn (DataSubjectRequest $record): bool => $record->isOpen() && ! $record->type->isAutomatic())
            ->modalDescription(__('filament-gdpr-dsar::filament-gdpr-dsar.actions.complete.description'))
            ->form([
                Textarea::make('response')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.response'))
                    ->required(),
            ])
            ->action(function (DataSubjectRequest $record, array $data): void {
                static::attempt(fn () => app(DsarManager::class)->complete($record, $data['response']), 'complete');
            });
    }

    /**
     * @param  class-string<Action|TableAction>  $class
     */
    public static function reject(string $class = Action::class): Action|TableAction
    {
        return $class::make('reject')
            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.actions.reject.label'))
            ->icon('heroicon-o-x-circle')
            ->color('danger')
            ->visible(fn (DataSubjectRequest $record): bool => $record->isOpen())
            ->form([
                Textarea::make('reason')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.reason'))
                    ->required(),
            ])
            ->action(function (DataSubjectRequest $record, array $data): void {
                static::attempt(fn () => app(DsarManager::class)->reject($record, $data['reason']), 'reject');
            });
    }

    /**
     * @param  class-string<Action|TableAction>  $class
     */
    public static function extend(string $class = Action::class): Action|TableAction
    {
        return $class::make('extend')
            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.actions.extend.label'))
            ->icon('heroicon-o-clock')
            ->color('warning')
            ->visible(fn (DataSubjectRequest $record): bool => $record->isOpen() && $record->extended_at === null)
            ->modalDescription(__('filament-gdpr-dsar::filament-gdpr-dsar.actions.extend.description'))
            ->form([
                Textarea::make('reason')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.extension_reason'))
                    ->required(),
            ])
            ->action(function (DataSubjectRequest $record, array $data): void {
                static::attempt(fn () => app(DsarManager::class)->extend($record, $data['reason']), 'extend');
            });
    }

    public static function download(string $class = Action::class): Action|TableAction
    {
        return $class::make('download')
            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.actions.download.label'))
            ->icon('heroicon-o-arrow-down-tray')
            ->color('gray')
            ->visible(fn (DataSubjectRequest $record): bool => filled($record->export_path))
            ->action(fn (DataSubjectRequest $record): StreamedResponse => Storage::disk(config('gdpr-dsar.disk'))
                ->download((string) $record->export_path));
    }

    /**
     * @return class-string<Model>|null
     */
    protected static function subjectClass(DataSubjectRequest $record): ?string
    {
        $type = $record->getAttribute('subject_type');

        if (! is_string($type)) {
            return null;
        }

        $class = Model::getActualClassNameForMorph($type);

        return is_subclass_of($class, Model::class) ? $class : null;
    }

    protected static function attempt(callable $callback, string $action): void
    {
        try {
            $callback();
        } catch (LogicException $e) {
            // The manager guards the workflow (closed, unverified, no subject): surface why instead of a 500.
            Notification::make()->danger()->title($e->getMessage())->send();

            return;
        }

        Notification::make()->success()->title(__("filament-gdpr-dsar::filament-gdpr-dsar.actions.{$action}.success"))->send();
    }
}
