<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LLMModel extends Model
{
    protected $fillable = [
        'name',
        'provider',
        'model_name',
        'api_key',
        'support_function_calling',
        'active',
    ];

    public function agents(): HasMany
    {
        return $this->hasMany(Agent::class);
    }
}
