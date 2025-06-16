<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandingcontentResource\Pages;
use App\Filament\Resources\LandingcontentResource\RelationManagers;
use App\Models\Landingcontent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LandingcontentResource extends Resource
{
    protected static ?string $model = Landingcontent::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('img_url')
                    ->directory('photo_landing')
                    ->visibility('public')
                    ->label('Landing Page Image'),
            ]);
    }

    public static function table(Table $table): Table
    {
        $contents = \App\Models\LandingContent::getCachedContents();
        return $table
            ->query(fn () => \App\Models\LandingContent::query()->whereIn('id', $contents->pluck('id')))
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('img_url')
                    ->label('Landing Page Image')
                    ->width('100%')
                    ->getStateUsing(fn ($record) => asset('storage/' . $record->img_url))
                    ->extraImgAttributes(['style' => 'object-fit: cover; border-radius: 8px;']),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListLandingcontents::route('/'),
            'create' => Pages\CreateLandingcontent::route('/create'),
            'edit' => Pages\EditLandingcontent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Management Content';
    }
}