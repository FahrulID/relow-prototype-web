<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Chiiya\FilamentAccessControl\Traits\AuthorizesPageAccess;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;
    use AuthorizesPageAccess;

    public static string $permission = 'product.read';

    public function mount(): void
    {
        static::authorizePageAccess();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
