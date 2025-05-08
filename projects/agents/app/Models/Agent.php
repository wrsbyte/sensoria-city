<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agent extends Model
{
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
}
