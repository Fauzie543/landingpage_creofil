<?php

namespace App\Filament\Resources\LandingcontentResource\Pages;

use App\Filament\Resources\LandingcontentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLandingcontent extends EditRecord
{
    protected static string $resource = LandingcontentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
