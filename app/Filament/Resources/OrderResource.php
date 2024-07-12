<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->label('Order number')
                    ->disabled(),
                Forms\Components\TextInput::make('user_id')
                    ->label('User ID')
                    ->disabled(),
                Forms\Components\TextInput::make('stripe_checkout_session_id')
                    ->label('Stripe Checkout Session ID')
                    ->disabled(),
                Forms\Components\TextInput::make('amount_shipping')
                    ->label('Shipping amount')
                    ->disabled(),
                Forms\Components\TextInput::make('amount_discount')
                    ->label('Discount amount')
                    ->disabled(),
                Forms\Components\TextInput::make('amount_tax')
                    ->label('Tax amount')
                    ->disabled(),
                Forms\Components\TextInput::make('amount_subtotal')
                    ->label('Subtotal amount')
                    ->disabled(),
                Forms\Components\TextInput::make('amount_total')
                    ->label('Total amount')
                    ->disabled(),
               Forms\Components\Fieldset::make('shipping_address')
                    ->label('Shipping address')
                    ->schema([
                        Forms\Components\TextInput::make('shipping_address.line1')
                            ->label('Address line 1')
                            ->disabled(),
                        Forms\Components\TextInput::make('shipping_address.line2')
                            ->label('Address line 2')
                            ->disabled(),
                        Forms\Components\TextInput::make('shipping_address.city')
                            ->label('City')
                            ->disabled(),
                        Forms\Components\TextInput::make('shipping_address.state')
                            ->label('State')
                            ->disabled(),
                        Forms\Components\TextInput::make('shipping_address.postal_code')
                            ->label('Postal code')
                            ->disabled(),
                        Forms\Components\TextInput::make('shipping_address.country')
                            ->label('Country')
                            ->disabled(),
                    ]),
                Forms\Components\Fieldset::make('billing_address')
                    ->label('Billing address')
                    ->schema([
                        Forms\Components\TextInput::make('billing_address.line1')
                            ->label('Address line 1')
                            ->disabled(),
                        Forms\Components\TextInput::make('billing_address.line2')
                            ->label('Address line 2')
                            ->disabled(),
                        Forms\Components\TextInput::make('billing_address.city')
                            ->label('City')
                            ->disabled(),
                        Forms\Components\TextInput::make('billing_address.state')
                            ->label('State')
                            ->disabled(),
                        Forms\Components\TextInput::make('billing_address.postal_code')
                            ->label('Postal code')
                            ->disabled(),
                        Forms\Components\TextInput::make('billing_address.country')
                            ->label('Country')
                            ->disabled(),
                    ]),

                Forms\Components\Select::make('status')
                    ->enum(OrderStatus::class)
                    ->options(OrderStatus::class )
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Order number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
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
