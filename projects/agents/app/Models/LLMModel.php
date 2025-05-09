<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LLMModel extends Model
{
    use HasFactory;

    protected $table = 'llm_models';

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
