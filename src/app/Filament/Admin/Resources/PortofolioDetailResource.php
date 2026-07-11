<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PortofolioDetailResource\Pages;
use App\Models\PortofolioDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortofolioDetailResource extends Resource
{
    protected static ?string $model = PortofolioDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('portfolio_id')
                    ->relationship('portofolio', 'title')
                    ->required(),

                Forms\Components\RichEditor::make('project_description')
                    ->required(),

                Forms\Components\RichEditor::make('problem_analysis')
                    ->required(),

                Forms\Components\RichEditor::make('system_requirements')
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('architecture_explanation')
                    ->required(),

                Forms\Components\RichEditor::make('tech_stack_explanation')
                    ->required(),

                Forms\Components\FileUpload::make('erd_image')
                    ->image()
                    ->directory('portfolio-details'),

                Forms\Components\FileUpload::make('flowchart_image')
                    ->image()
                    ->directory('portfolio-details'),

                Forms\Components\RichEditor::make('conclusion')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('portofolio.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListPortofolioDetails::route('/'),
            'create' => Pages\CreatePortofolioDetail::route('/create'),
            'edit' => Pages\EditPortofolioDetail::route('/{record}/edit'),
        ];
    }
}
