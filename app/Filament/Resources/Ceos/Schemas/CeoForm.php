<?php

namespace App\Filament\Resources\Ceos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CeoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                section::make('Details')->schema([
                    TextInput::make('name')->label('Name :'),
                    Textarea::make('paragraph_1')->label('Paragraph_1 :')->rows(5)->required(),
                    Textarea::make('paragraph_2')->label('Paragraph_2 :')->rows(5)->required(),
                    Textarea::make('paragraph_3')->label('Paragraph_3 :')->rows(5)->required(),
                ])->columnSpanFull(),

                section::make('Images')->description('You must upload 3 images.')->schema([
                    FileUpload::make('images')
                        ->label('Images')
                        ->directory('ceo/images')
                        ->disk('public')
                        ->multiple()
                        ->image()
                        ->openable()
                        ->imageEditor()
                        ->required()
                        ->maxFiles(3)
                        ->minFiles(3)
                        ->downloadable()
                        ->afterStateHydrated(function (FileUpload $component) {
                            $record = $component->getRecord();
                            if ($record) {
                                $paths = $record->images()
                                    ->pluck('path')
                                    ->all();

                                // عَبّي القيمة بالـ component
                                $component->state($paths);
                            }
                        })
                        ->columnSpanFull(),

                ])->columnSpanFull(),

            ]);
    }
}
