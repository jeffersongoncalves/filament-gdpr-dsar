<?php

namespace JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests\DataSubjectRequestResource;

class ListDataSubjectRequests extends ListRecords
{
    protected static string $resource = DataSubjectRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
