<?php

namespace App\Filament\Admin\Resources\PortofolioDetailResource\Pages;

use App\Filament\Admin\Resources\PortofolioDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortofolioDetail extends EditRecord
{
    protected static string $resource = PortofolioDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
