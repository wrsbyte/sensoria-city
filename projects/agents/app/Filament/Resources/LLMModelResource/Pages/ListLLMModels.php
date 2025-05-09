<?php

namespace App\Filament\Resources\LLMModelResource\Pages;

use App\Filament\Resources\LLMModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLLMModels extends ListRecords
{
    protected static string $resource = LLMModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
