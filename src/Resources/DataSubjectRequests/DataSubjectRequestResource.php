<?php

namespace JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests;

use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use JeffersonGoncalves\Filament\GdprDsar\Actions\DsarActions;
use JeffersonGoncalves\Filament\GdprDsar\GdprDsarPlugin;
use JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests\Pages\CreateDataSubjectRequest;
use JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests\Pages\ListDataSubjectRequests;
use JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests\Pages\ViewDataSubjectRequest;
use JeffersonGoncalves\Filament\GdprDsar\Support\Labels;
use JeffersonGoncalves\GdprDsar\Models\DataSubjectRequest;

class DataSubjectRequestResource extends Resource
{
    protected static ?string $model = DataSubjectRequest::class;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Select::make('type')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.type'))
                    ->options(Labels::types())
                    ->required(),
                TextInput::make('requester_name')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.requester_name'))
                    ->maxLength(255),
                TextInput::make('requester_email')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.requester_email'))
                    ->email()
                    ->maxLength(255),
                Textarea::make('details')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.details')),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1)
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('type')
                            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.type'))
                            ->formatStateUsing(fn (BackedEnum $state): string => Labels::type($state->value)),
                        TextEntry::make('status')
                            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.status'))
                            ->formatStateUsing(fn (BackedEnum $state): string => Labels::status($state->value))
                            ->badge()
                            ->color(fn (BackedEnum $state): string => Labels::statusColor($state->value)),
                        TextEntry::make('requester_name')
                            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.requester_name'))
                            ->placeholder('-'),
                        TextEntry::make('requester_email')
                            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.requester_email'))
                            ->placeholder('-'),
                        TextEntry::make('subject')
                            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.subject'))
                            ->state(fn (DataSubjectRequest $record): ?string => Labels::subject($record))
                            ->placeholder('-'),
                        TextEntry::make('due_at')
                            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.due_at'))
                            ->dateTime()
                            ->color(fn (DataSubjectRequest $record): ?string => static::isOverdue($record) ? 'danger' : null),
                        TextEntry::make('verified_at')
                            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.verified_at'))
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('completed_at')
                            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.completed_at'))
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('details')
                            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.details'))
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('response')
                            ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.response'))
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                TextColumn::make('type')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.type'))
                    ->formatStateUsing(fn (BackedEnum $state): string => Labels::type($state->value)),
                TextColumn::make('requester_name')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.requester_name'))
                    ->description(fn (DataSubjectRequest $record): ?string => $record->getAttribute('requester_email'))
                    ->searchable(['requester_name', 'requester_email'])
                    ->placeholder('-'),
                TextColumn::make('status')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.status'))
                    ->formatStateUsing(fn (BackedEnum $state): string => Labels::status($state->value))
                    ->badge()
                    ->color(fn (BackedEnum $state): string => Labels::statusColor($state->value)),
                IconColumn::make('verified')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.verified'))
                    ->state(fn (DataSubjectRequest $record): bool => $record->isVerified())
                    ->boolean(),
                TextColumn::make('due_at')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.due_at'))
                    ->date()
                    ->sortable()
                    ->color(fn (DataSubjectRequest $record): ?string => static::isOverdue($record) ? 'danger' : null),
                TextColumn::make('created_at')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('due_at')
            ->filters([
                SelectFilter::make('status')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.status'))
                    ->options(Labels::statuses()),
                SelectFilter::make('type')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.fields.type'))
                    ->options(Labels::types()),
                Filter::make('overdue')
                    ->label(__('filament-gdpr-dsar::filament-gdpr-dsar.filters.overdue'))
                    ->query(fn (Builder $query): Builder => $query->scopes('overdue')),
            ])
            ->actions([
                ViewAction::make(),
                ActionGroup::make(DsarActions::all(TableAction::class)),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDataSubjectRequests::route('/'),
            'create' => CreateDataSubjectRequest::route('/create'),
            'view' => ViewDataSubjectRequest::route('/{record}'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('filament-gdpr-dsar::filament-gdpr-dsar.resource.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-gdpr-dsar::filament-gdpr-dsar.resource.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return GdprDsarPlugin::get()->getNavigationGroup();
    }

    public static function getNavigationSort(): ?int
    {
        return GdprDsarPlugin::get()->getNavigationSort();
    }

    public static function getNavigationIcon(): ?string
    {
        return GdprDsarPlugin::get()->getNavigationIcon();
    }

    public static function getSlug(): string
    {
        return GdprDsarPlugin::get()->getSlug();
    }

    public static function getNavigationBadge(): ?string
    {
        $open = DataSubjectRequest::query()->scopes('open')->count();

        return $open > 0 ? (string) $open : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return DataSubjectRequest::query()->scopes('overdue')->exists() ? 'danger' : 'warning';
    }

    protected static function isOverdue(DataSubjectRequest $record): bool
    {
        return $record->isOpen() && $record->due_at->isPast();
    }
}
