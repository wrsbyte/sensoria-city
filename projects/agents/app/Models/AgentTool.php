<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AgentTool extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'function',
        'active',
    ];

    public function agents(): BelongsToMany
    {
        return $this->belongsToMany(Agent::class, 'agent_tool_uses')
            ->withPivot('stop_at_tool')
            ->withTimestamps();
    }
}
