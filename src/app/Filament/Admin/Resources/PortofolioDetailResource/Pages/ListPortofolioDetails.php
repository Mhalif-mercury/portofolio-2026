<?php

namespace App\Filament\Admin\Resources\PortofolioDetailResource\Pages;

use App\Filament\Admin\Resources\PortofolioDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortofolioDetails extends ListRecords
{
    protected static string $resource = PortofolioDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
