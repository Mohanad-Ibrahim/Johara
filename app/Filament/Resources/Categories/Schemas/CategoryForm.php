<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;


class CategoryForm
{
    public static function configure(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Category Name')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('image')
                    ->label('Category Image')
                    ->image() //
                    ->disk('public')
                    ->imageEditor()
                    ->directory('categories') // يخزن الصور داخل مجلد storage/app/public/categories
                    ->required(),
            ]);
    }
}
