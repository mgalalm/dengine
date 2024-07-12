<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->prefixIcon('heroicon-o-currency-euro')
                    ->hint('Price in cents')
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull()
                    ->toolbarButtons(['bold', 'italic', 'underline', 'unorderedList', 'orderedList'])
                    ->label('Description')
                    ->required(),

//                Forms\Components\Select::make('categories')
//                    ->live()
//                    ->name('parent')
//                    ->label('Parent Category')
//                    ->relationship('categories', 'name', modifyQueryUsing: function (Builder $query) {
//
//                        return $query->whereNull('parent_id');
//                    }),
//                Forms\Components\Select::make('categories')
////                    ->multiple()
//                    ->relationship('categories', 'name', modifyQueryUsing: function (Builder $query, Forms\Get $get) {
//                        return $query->where('parent_id', $get('categories'));
//                    }),


                Forms\Components\Toggle::make('is_published')
                ->default(true),
                Forms\Components\Toggle::make('is_featured')
                ->default(false),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
//                Tables\Columns\TextColumn::make('description')
//                    ->searchable()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('price')

//                    ->searchable()
//                    ->sortable(),
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
            RelationManagers\CategoriesRelationManager::class,
            RelationManagers\VariantsRelationManager::class,
            RelationManagers\ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
