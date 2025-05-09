<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentToolUse extends Model
{
    use HasFactory;

    protected $fillable = [
        'stop_at_tool',
        'agent_id',
        'agent_tool_id',
    ];

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    public function agentTool(): BelongsTo
    {
        return $this->belongsTo(AgentTool::class);
    }
}
