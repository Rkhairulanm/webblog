<?php

namespace App\Filament\Resources\ContentResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ContentResource;
use Filament\Resources\Pages\ListRecords\Tab;

class ListContents extends ListRecords
{
    protected static string $resource = ContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'Info' => Tab::make()->modifyQueryUsing(function ($query) {
                $query->whereIn('type', ['address', 'phone', 'email']);
            }),
            'Sosmed' => Tab::make()->modifyQueryUsing(function ($query) {
                $query->whereIn('type', ['instagram', 'twitter', 'facebook']);
            }),
        ];
    }
}
