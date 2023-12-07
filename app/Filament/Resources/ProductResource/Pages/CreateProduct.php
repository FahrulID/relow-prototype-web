<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Chiiya\FilamentAccessControl\Traits\AuthorizesPageAccess;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    use AuthorizesPageAccess;

    public static string $permission = 'product.create';

    public function mount(): void
    {
        static::authorizePageAccess();
    }
}
