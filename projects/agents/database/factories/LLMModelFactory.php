<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LLMModel>
 */
class LLMModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'provider' => $this->faker->randomElement(['openai', 'deepseek']),
            'model_name' => $this->faker->bothify('model-#####'),
            'api_key' => 'sk-' . $this->faker->sha1,
            'support_function_calling' => $this->faker->boolean(),
            'active' => $this->faker->boolean(),
        ];
    }
}
