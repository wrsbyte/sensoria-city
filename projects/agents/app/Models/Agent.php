<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'llm_model_id',
        'instructions',
        'active',
    ];

    public function llmModel(): BelongsTo
    {
        return $this->belongsTo(LLMModel::class);
    }

    public function tools(): BelongsToMany
    {
        return $this->belongsToMany(AgentTool::class, 'agent_tool_uses')
            ->withPivot('stop_at_tool')
            ->withTimestamps();
    }
}
