<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\FilamentUser;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('order_product_id')
                    ->options(function () {
                        return Product::all()->pluck('product_name', 'product_id');
                    }),
                Forms\Components\TextInput::make('order_notes')
                    ->autofocus(),
                Forms\Components\FileUpload::make('order_bukti_pembayaran')
                    ->autofocus(),
                Forms\Components\Select::make('order_status')
                    ->visible(FilamentUser::find(auth()->id())->role == 1)
                    ->options([
                        'pending' => 'Pending',
                        'payment confirmed' => 'Payment Confirmed',
                        'dropped off' => 'Dropped Off',
                        'picked up' => 'Picked Up',
                        'cleaning' => 'Cleaning',
                        'shipping' => 'Shipping',
                        'delivered' => 'Delivered',
                        'canceled' => 'Canceled',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_notes')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_status')
                    ->sortable(),
            ])
            ->filters([])
            ->modifyQueryUsing(fn (Builder $query) => (FilamentUser::find(auth()->id())->role == 2) ? $query->where('order_user_id', auth()->id()) : $query)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
