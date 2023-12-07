<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Chiiya\FilamentAccessControl\Traits\AuthorizesPageAccess;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
    use AuthorizesPageAccess;

    public static string $permission = 'order.create';

    public function mount(): void
    {
        static::authorizePageAccess();
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['order_user_id'] = auth()->id();
        $data['order_code'] = "Menunggu Konfirmasi Admin";

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
