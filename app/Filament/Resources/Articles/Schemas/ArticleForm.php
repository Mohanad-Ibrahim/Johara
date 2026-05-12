<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([Section::make('Article')
            ->schema([
                TextInput::make('title')
                    ->label('Title :')
                    ->required(),

                Textarea::make('description')
                    ->label('Description :')
                    ->rows(5)
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Image :')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('articles/cover')
                    ->required(),
            ])
            ->columns(1)
            ->columnSpanFull(),

            Section::make('Paragraphs')
                ->schema([
                    // الفقرات: فيها ترتيب
                    Repeater::make('paragraphs')
                        ->label('Paragraphs')
                        ->relationship('paragraphs')   // Article::paragraphs()
                        ->orderColumn('order')         // ترتيب للفقرات فقط
                        ->reorderable()
                        ->addActionLabel('إضافة فقرة')
                        ->schema([
                            TextInput::make('title')
                                ->label('Title')
                                ->required(),

                            Textarea::make('body')
                                ->label('Body')
                                ->rows(5)
                                ->required()
                                ->columnSpanFull(),

//                             الصور: بدون ترتيب

                                    FileUpload::make('image')
                                        ->label('Image :')
                                        ->image()
                                        ->disk('public')
                                        ->directory('articles/paragraphs')
                                        ->openable()
                                        ->imageEditor()
                                        ->downloadable(),

                        ])
                        ->columns(1)
                        ->itemLabel(fn (array $state) => $state['title'] ?? 'Paragraph')
                        ->columnSpanFull(),
                ])
                ->columns(1)
                ->columnSpanFull(),
        ]);
    }
}
