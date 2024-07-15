<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'categories';
    protected bool $allowsDuplicates = true;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('parent_id')
                    ->relationship('parent', 'name', modifyQueryUsing: function (Builder $query) {
                        return $query->whereNull('parent_id');
                    }  )
                    ->placeholder('Select a parent category')
                    ->nullable(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn(Tables\Actions\AttachAction $action) => [
                        $action
                            ->getRecordSelect()
                            ->live(),
                        Forms\Components\Select::make('subcategoryId')
                            ->label('Subcategory')
                            ->relationship('parent', 'name', modifyQueryUsing: function (Builder $query, Get $get) {
                                return $query->where('parent_id', $get('recordId'));
                            })
                            ->placeholder('Select a parent category')
                            ->searchable()
                            ->multiple()
                            ->preload()
                            ->nullable()
                            ->dehydrated()
                        ,
                    ])
                    ->recordSelectOptionsQuery(function (Builder $query) {
                        return $query->whereNull('parent_id');
                    })->mutateFormDataUsing(function (array $data) {
                        $data['recordId'] = $data['subcategoryId'];
                        return $data;
                    }),


            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
