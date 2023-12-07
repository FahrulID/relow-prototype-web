<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Chiiya\FilamentAccessControl\Traits\AuthorizesPageAccess;

class EditOrder extends EditRecord
{
    use AuthorizesPageAccess;
    protected static string $resource = OrderResource::class;

    public static string $permission = 'order.update';

    public function mount(int | string $record): void
    {
        parent::mount($record);
        static::authorizePageAccess();
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['order_status'] == "payment confirmed")
            $data['order_code'] = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
