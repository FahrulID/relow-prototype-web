<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Chiiya\FilamentAccessControl\Traits\AuthorizesPageAccess;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    use AuthorizesPageAccess;
    protected static string $resource = OrderResource::class;

    public static string $permission = 'order.read';

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
