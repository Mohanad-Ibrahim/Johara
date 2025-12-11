<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Event Details :')->schema([
                    textInput::make('location')
                        ->label('Location :')
                        ->placeholder('Ex : UAE,Dubai')
                        ->required(),

                    textInput::make('date')
                        ->label('Date :')
                        ->placeholder('Ex : May 10 - 20,2024')
                        ->required(),

                    textArea::make('description')
                        ->label('Description :')
                        ->placeholder(' Attending an architecture seminar on modern urban design. ')
                        ->required()
                        ->columnSpanFull(),

                    FileUpload::make('image')
                        ->label('Image :')
                        ->disk('public')
                        ->directory('Events')
                        ->required()
                        ->columnSpanFull(),
                ])->columnSpanFull()->columns(2)
            ]);
    }
}
