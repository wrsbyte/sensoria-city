<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LLMModelResource\Pages;
use App\Filament\Resources\LLMModelResource\Enums;
use App\Filament\Resources\LLMModelResource\RelationManagers;
use App\Models\LLMModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LLMModelResource extends Resource
{
    protected static ?string $model = LLMModel::class;
    protected static ?string $navigationGroup = 'Agents';
    protected static ?string $pluralLabel = 'LLM Models';
    protected static ?string $modelLabel = 'LLM Model';
    protected static ?string $slug = 'llm-models';
    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('LLM Model Name. e.g. My LLM Model')
                    ->columnSpanFull(),
                Forms\Components\Radio::make('provider')
                    ->label('Provider')
                    ->options(Enums\Provider::class)
                    ->helperText('Select the provider for this LLM model.')
                    ->required(),
                Forms\Components\TextInput::make('model_name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Model Name. e.g. gpt-3.5-turbo, deepseek-chat'),
                Forms\Components\TextInput::make('api_key')
                    ->required()
                    ->maxLength(255)
                    ->password()
                    ->revealable()
                    ->placeholder('API Key. e.g. sk-...')
                    ->helperText('API key for the LLM model provider. Make sure to keep it secret.'),
                Forms\Components\Checkbox::make('support_function_calling')
                    ->label('Support Function Calling')
                    ->helperText('Enable this if the LLM model supports function calling.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->placeholder('LLM Model Name'),
                Tables\Columns\TextColumn::make('provider')
                    ->label('Provider')
                    ->sortable()
                    ->badge()
                    ->searchable()
                    ->placeholder('Provider Name'),
                Tables\Columns\TextColumn::make('model_name')
                    ->label('Model Name')
                    ->sortable()
                    ->searchable()
                    ->placeholder('Model Name'),
                Tables\Columns\IconColumn::make('support_function_calling')
                    ->label('Function Calling')
                    ->sortable()
                    ->boolean()
                    ->placeholder('Supports Function Calling')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                Tables\Columns\ToggleColumn::make('active')
                    ->label('Active')
                    ->sortable()
                    ->placeholder('Is Active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable()
                    ->dateTime()
                    ->placeholder('Creation Date'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->sortable()
                    ->dateTime()
                    ->placeholder('Last Updated'),
            ])
            ->filters([
                Filters\SelectFilter::make('provider')
                    ->label('Provider')
                    ->multiple()
                    ->placeholder('Select Provider')
                    ->options(Enums\Provider::class),
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
            'index' => Pages\ListLLMModels::route('/'),
            'create' => Pages\CreateLLMModel::route('/create'),
            'edit' => Pages\EditLLMModel::route('/{record}/edit'),
        ];
    }
}
