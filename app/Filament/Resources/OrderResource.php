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
                Forms\Components\Section::make('Order Summary')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('id')
                            ->label('Order number'),
                        Forms\Components\TextInput::make('amount_shipping')
                            ->label('Shipping amount'),
                        Forms\Components\TextInput::make('amount_discount')
                            ->label('Discount amount'),
                        Forms\Components\TextInput::make('amount_tax')
                            ->label('Tax amount'),
                        Forms\Components\TextInput::make('amount_subtotal')
                            ->label('Subtotal amount'),
                        Forms\Components\TextInput::make('amount_total')
                            ->label('Total amount'),
                        Forms\Components\Select::make('status')
                            ->enum(OrderStatus::class)
                            ->options(OrderStatus::class )
                            ->required(),
                    ])->disabled(fn (string $operation) => $operation !== 'create'),

                Forms\Components\Section::make('Customer Information')
                    ->collapsible()
//                    ->aside()
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('user.name')
                            ->relationship('user', 'name')
                            ->label('Name'),
                        Forms\Components\Select::make('user.email')
                            ->relationship('user', 'email')
                            ->label('Email'),
                    ])->disabled(fn (string $operation) => $operation !== 'create'),

                Forms\Components\Section::make('Shipping address')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('shipping_address.line1')
                            ->label('Address line 1'),
                        Forms\Components\TextInput::make('shipping_address.line2')
                            ->label('Address line 2'),
                        Forms\Components\TextInput::make('shipping_address.city')
                            ->label('City'),
                        Forms\Components\TextInput::make('shipping_address.state')
                            ->label('State'),
                        Forms\Components\TextInput::make('shipping_address.postal_code')
                            ->label('Postal code'),
                        Forms\Components\TextInput::make('shipping_address.country')
                            ->label('Country'),
                    ])->disabled(fn (string $operation) => $operation !== 'create'),
                Forms\Components\Section::make('Billing address')
                    ->collapsible()
                    ->collapsed()
                    ->columns(2)
                    ->label('Billing address')
                    ->schema([
                        Forms\Components\TextInput::make('billing_address.line1')
                            ->label('Address line 1'),
                        Forms\Components\TextInput::make('billing_address.line2')
                            ->label('Address line 2'),
                        Forms\Components\TextInput::make('billing_address.city')
                            ->label('City'),
                        Forms\Components\TextInput::make('billing_address.state')
                            ->label('State'),
                        Forms\Components\TextInput::make('billing_address.postal_code')
                            ->label('Postal code'),
                        Forms\Components\TextInput::make('billing_address.country')
                            ->label('Country')
                    ])->disabled(fn (string $operation) => $operation !== 'create'),

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
