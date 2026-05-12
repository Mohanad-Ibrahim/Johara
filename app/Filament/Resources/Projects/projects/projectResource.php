<?php

namespace App\Filament\Resources\Projects\projects;

use App\Filament\Resources\Projects\projects\Pages\Createproject;
use App\Filament\Resources\Projects\projects\Pages\Editproject;
use App\Filament\Resources\Projects\projects\Pages\Listprojects;
use App\Filament\Resources\Projects\projects\Pages\Viewproject;
use App\Filament\Resources\Projects\projects\Schemas\projectForm;
use App\Filament\Resources\Projects\projects\Schemas\projectInfolist;
use App\Filament\Resources\Projects\projects\Tables\projectsTable;
use App\Models\Projects\Project;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class projectResource extends Resource
{
    protected static ?string $model = project::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice2;

    protected static ?string $recordTitleAttribute = 'Projects';
    protected static ?int $navigationSort =2;

    public static function form(Schema $schema): Schema
    {
        return projectForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return projectInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return projectsTable::configure($table);
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
            'index' => Listprojects::route('/'),
            'create' => Createproject::route('/create'),
            'view' => Viewproject::route('/{record}'),
            'edit' => Editproject::route('/{record}/edit'),
        ];
    }
}
