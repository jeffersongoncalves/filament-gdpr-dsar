<?php

namespace JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests\DataSubjectRequestResource;
use JeffersonGoncalves\GdprDsar\DsarManager;
use JeffersonGoncalves\GdprDsar\Enums\RequestType;

class CreateDataSubjectRequest extends CreateRecord
{
    protected static string $resource = DataSubjectRequestResource::class;

    /**
     * Open through the manager: it sets the status, the legal deadline and fires DataSubjectRequestOpened.
     *
     * @param  array<string, mixed>  $data
     */
    protected function handleRecordCreation(array $data): Model
    {
        return app(DsarManager::class)->open(RequestType::from($data['type']), null, [
            'name' => $data['requester_name'] ?? null,
            'email' => $data['requester_email'] ?? null,
            'details' => $data['details'] ?? null,
        ]);
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('view', ['record' => $this->getRecord()]);
    }
}
