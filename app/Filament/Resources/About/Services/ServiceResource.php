<?php

namespace App\Filament\Resources\About\Services;

use App\Filament\Resources\About\Services\Pages\CreateService;
use App\Filament\Resources\About\Services\Pages\EditService;
use App\Filament\Resources\About\Services\Pages\ListServices;
use App\Filament\Resources\About\Services\Pages\ViewService;
use App\Filament\Resources\About\Services\Schemas\ServiceForm;
use App\Filament\Resources\About\Services\Schemas\ServiceInfolist;
use App\Filament\Resources\About\Services\Tables\ServicesTable;
use App\Models\About\Service;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentList;

    protected static ?string $recordTitleAttribute = 'Services';
    protected static ?int $navigationSort =3;

    public static function canViewAny(): bool
    {
        return false;
    }
    public static function form(Schema $schema): Schema
    {
        return ServiceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ServiceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServicesTable::configure($table);
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
            'index' => ListServices::route('/'),
            'create' => CreateService::route('/create'),
            'view' => ViewService::route('/{record}'),
            'edit' => EditService::route('/{record}/edit'),
        ];
    }
}
