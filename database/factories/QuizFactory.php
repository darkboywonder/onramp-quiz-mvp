<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->words(rand(2, 4), true),
            'module_id' => Module::factory(),
        ];
    }
}
