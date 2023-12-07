<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Chiiya\FilamentAccessControl\Traits\AuthorizesPageAccess;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    use AuthorizesPageAccess;

    public static string $permission = 'product.edit';

    public function mount(int | string $record): void
    {
        parent::mount($record);
        static::authorizePageAccess();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
