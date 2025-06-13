<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('img_url')
                    ->directory('photo_menu')
                    ->visibility('public')
                    ->label('Menu Image'),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
         return $table
        ->columns([
            Stack::make([
                ImageColumn::make('img_url')
                    ->label('Foto Menu')
                    ->height(150)
                    ->width('100%')
                    ->getStateUsing(fn ($record) => asset('storage/' . $record->img_url))
                    ->extraImgAttributes(['style' => 'object-fit: cover; border-radius: 8px;']),
                    

                TextColumn::make('name')
                    ->weight('bold')
                    ->size('lg')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->color('gray')
                    ->searchable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->prefix('Rp. ')
                    ->color('success'),

                TextColumn::make('description')
                    ->label('Description')
                    ->color('info'),
                    
                IconColumn::make('status')
                    ->label('Status'),
            ]),
        ])
        ->contentGrid([
            'md' => 2,
            'xl' => 3,
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ]);
       
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}