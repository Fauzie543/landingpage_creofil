<?php

namespace App\Filament\Resources\LandingcontentResource\Pages;

use App\Filament\Resources\LandingcontentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLandingcontents extends ListRecords
{
    protected static string $resource = LandingcontentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
