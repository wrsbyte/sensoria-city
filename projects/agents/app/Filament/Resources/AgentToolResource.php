<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgentToolResource\Pages;
use App\Filament\Resources\AgentToolResource\RelationManagers;
use App\Models\AgentTool;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgentToolResource extends Resource
{
    protected static ?string $model = AgentTool::class;
    protected static ?string $navigationGroup = 'Agents';
    protected static ?string $navigationIcon = 'heroicon-o-wrench';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Agent tool. e.g. My Tool'),
                Forms\Components\TextInput::make('function')
                    ->required()
                    ->maxLength(255)
                    ->unique(table: AgentTool::class, ignoreRecord: true)
                    ->regex('/^(?!_)(?!.*_$)(?!.*_{3})[a-z_]+$/')
                    ->helperText('Only lowercase letters, numbers, and underscores are allowed.')
                    ->placeholder('tool_rag_search'),
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
                    ->description(fn (AgentTool $record): string => $record->function)
                    ->copyable()
                    ->copyMessage('Agent tool name copied to clipboard')
                    ->placeholder('Agent Tool'),
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
            'index' => Pages\ListAgentTools::route('/'),
            'create' => Pages\CreateAgentTool::route('/create'),
            'edit' => Pages\EditAgentTool::route('/{record}/edit'),
        ];
    }
}
