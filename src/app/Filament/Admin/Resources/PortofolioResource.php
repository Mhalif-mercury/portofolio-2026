<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PortofolioResource\Pages;
use App\Filament\Admin\Resources\PortofolioResource\RelationManagers;
use App\Models\Portofolio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PortofolioResource extends Resource
{
    protected static ?string $model = Portofolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {

                        $set('slug', Str::slug($state));

                    })
                    ->maxLength(255),

                Forms\Components\TextInput::make('slug')
                    ->unique(ignoreRecord: true)
                    ->required(),

                Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->directory('portfolio'),

                Forms\Components\Textarea::make('short_description')
                    ->required()
                    ->rows(3),

                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('github_url')
                    ->url(),

                Forms\Components\TextInput::make('live_url')
                    ->url(),

                Forms\Components\TagsInput::make('tech_stack'),

                Forms\Components\TextInput::make('year')
                    ->numeric(),

                Forms\Components\Toggle::make('is_featured'),

                Forms\Components\Toggle::make('is_active')
                    ->default(true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('year'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPortofolios::route('/'),
            'create' => Pages\CreatePortofolio::route('/create'),
            'edit' => Pages\EditPortofolio::route('/{record}/edit'),
        ];
    }
}
