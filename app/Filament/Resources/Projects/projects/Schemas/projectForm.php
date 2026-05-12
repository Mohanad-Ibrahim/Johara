<?php

namespace App\Filament\Resources\Projects\projects\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class projectForm
{
    public static function configure(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required()->columnSpanFull(),

                Textarea::make('main_description')
                    ->label('Main Description')
                    ->rows(5)
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('second_description')
                    ->label('Second Description')
                    ->rows(5)
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('third_description')
                    ->label('Third Description')
                    ->rows(5)
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('location')
                    ->label('Location')
                    ->required(),

                TextInput::make('date')
                    ->label('Completion Year')
                    ->required(),

                TextInput::make('contractor')
                    ->label('Contractor')
                    ->required(),

                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->preload()
                    ->required()
                    ->searchable()
                    ->native(false),


                Repeater::make('details')
                    ->label('Details')
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required(),
                        TextInput::make('text')
                            ->label('Text')
                            ->required(),
                    ])
                    ->collapsible()
                    ->reorderable()
                    ->addActionLabel('إضافة عنصر')
                    ->columns(2)->columnSpanFull(),


                FileUpload::make('mainImage')
                    ->label('Main Image :')
                    ->image() //
                    ->disk('public')
                    ->directory('projects/main') // يخزن الصور داخل مجلد storage/app/public/categories
                    ->columnSpanFull()
                    ->imageEditor()
                    ->required(),
                FileUpload::make('interior_images')
                    ->label('Interior Images')
                    ->disk('public')
                    ->directory('projects/interior')
                    ->multiple()
                    ->image()
                    ->reorderable()
                    ->openable()
                    ->imageEditor()
                    ->downloadable()
                    ->afterStateHydrated(function (FileUpload $component) {
                        $record = $component->getRecord();
                        if ($record) {
                            $paths = $record->images()
                                ->where('type', 'interior')
                                ->pluck('path')
                                ->all();

                            // عَبّي القيمة بالـ component
                            $component->state($paths);
                        }
                    })
                    ->columnSpanFull(),

                FileUpload::make('exterior_images')
                    ->label('Exterior Images')
                    ->directory('projects/exterior')
                    ->disk('public')
                    ->multiple()
                    ->image()
                    ->reorderable()
                    ->openable()
                    ->imageEditor()
                    ->downloadable()
                    ->afterStateHydrated(function (FileUpload $component) {
                        $record = $component->getRecord();
                        if ($record) {
                            $paths = $record->images()
                                ->where('type', 'exterior')
                                ->pluck('path')
                                ->all();

                            // عَبّي القيمة بالـ component
                            $component->state($paths);
                        }
                    })
                    ->columnSpanFull(),

            ]);
    }
}
