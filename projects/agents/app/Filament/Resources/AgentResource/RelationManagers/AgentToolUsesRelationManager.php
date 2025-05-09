<?php

namespace App\Filament\Resources\AgentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgentToolUsesRelationManager extends RelationManager
{
    protected static string $relationship = 'agentToolUses';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('agent_tool_id')
                    ->label('Tool')
                    ->options(
                        \App\Models\AgentTool::all()->pluck('name', 'id')
                    )
                    ->searchable()
                    ->required()
                    ->placeholder('Select Tool'),
                Forms\Components\Toggle::make('stop_at_tool')
                    ->helperText('Stop at tool on true will stop the agent from running further after this tool is used.')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('stop_at_tool')
            ->columns([
                Tables\Columns\TextColumn::make('agentTool.name')
                    ->label('Agent Tool')
                    ->sortable()
                    ->badge()
                    ->searchable()
                    ->placeholder('Agent Tool'),
                Tables\Columns\IconColumn::make('stop_at_tool')
                    ->label('Stop at Tool')
                    ->sortable()
                    ->boolean()
                    ->placeholder('Stop at Tool')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
