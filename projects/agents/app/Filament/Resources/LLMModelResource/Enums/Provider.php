<?php

namespace App\Filament\Resources\LLMModelResource\Enums;

use Filament\Support\Contracts\HasLabel;

enum Provider: string implements HasLabel
{
    case OpenAI = 'openai';
    case DeepSeek = 'deepseek';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::OpenAI => 'OpenAI',
            self::DeepSeek => 'DeepSeek',
        };
    }
}
