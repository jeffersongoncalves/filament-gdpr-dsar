<?php

namespace JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests\Pages;

use Filament\Resources\Pages\ViewRecord;
use JeffersonGoncalves\Filament\GdprDsar\Actions\DsarActions;
use JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests\DataSubjectRequestResource;

class ViewDataSubjectRequest extends ViewRecord
{
    protected static string $resource = DataSubjectRequestResource::class;

    protected function getHeaderActions(): array
    {
        return DsarActions::all();
    }
}
