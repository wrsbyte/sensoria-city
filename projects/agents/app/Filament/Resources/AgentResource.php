<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgentResource\Pages;
use App\Filament\Resources\AgentResource\RelationManagers;
use App\Models\Agent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class AgentResource extends Resource
{
    protected static ?string $model = Agent::class;
    protected static ?string $navigationGroup = 'Agents';
    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Agent Name. e.g. My Agent'),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(table: Agent::class, ignoreRecord: true)
                    ->regex('/^(?!-)(?!.*-$)(?!.*-{3})[a-z-]+$/')
                    ->helperText('Only lowercase letters, numbers, and hyphens are allowed.')
                    ->placeholder('agent-name'),
                Forms\Components\Select::make('llm_model_id')
                    ->label('LLM Model')
                    ->options(
                        \App\Models\LLMModel::all()->pluck('name', 'id')
                    )
                    ->searchable()
                    ->required()
                    ->placeholder('Select LLM Model'),
                Forms\Components\Textarea::make('instructions')
                    ->rows(4)
                    ->maxLength(65535)
                    ->placeholder(
                        '#  Agent Instructions

## Provide instructions to the agent
Todo all tasks.'
                    )
                    ->helperText('Use markdown syntax for formatting.'),
                Forms\Components\Toggle::make('active')
                    ->label('Active')
                    ->default(true)
                    ->inline(false)
                    ->required(),
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
                    ->description(fn (Agent $record): string => $record->slug)
                    ->copyable()
                    ->copyMessage('Agent name copied to clipboard')
                    ->placeholder('Agent Name'),
                Tables\Columns\TextColumn::make('llmModel.name')
                    ->label('LLM Model')
                    ->sortable()
                    ->badge()
                    ->searchable()
                    ->placeholder('LLM Model Name'),
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
                Filters\SelectFilter::make('llm_model_id')
                    ->label('LLM Model')
                    ->multiple()
                    ->placeholder('Select LLM Model')
                    ->options(
                        \App\Models\LLMModel::all()->pluck('name', 'id')
                    ),
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
            AgentResource\RelationManagers\AgentToolUsesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgents::route('/'),
            'create' => Pages\CreateAgent::route('/create'),
            'edit' => Pages\EditAgent::route('/{record}/edit'),
        ];
    }
}
