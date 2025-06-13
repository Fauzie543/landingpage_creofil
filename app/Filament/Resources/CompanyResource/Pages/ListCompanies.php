<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Actions;
use App\Models\Company;
use Filament\Resources\Pages\ListRecords;

class ListCompanies extends ListRecords
{
    protected static string $resource = CompanyResource::class;

    
     protected function canCreate(): bool
    {
        // Hanya bisa create kalau belum ada data
        return Company::count() === 0;
    }
}