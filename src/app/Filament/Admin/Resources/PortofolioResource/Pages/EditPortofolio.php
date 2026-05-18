<?php

namespace App\Filament\Admin\Resources\PortofolioResource\Pages;

use App\Filament\Admin\Resources\PortofolioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortofolio extends EditRecord
{
    protected static string $resource = PortofolioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
