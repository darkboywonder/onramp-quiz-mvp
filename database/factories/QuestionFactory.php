<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    public function definition()
    {
        return [
            'text' => $this->faker->sentence,
            'answer' => $this->faker->words(1, true),
            'quiz_id' => Quiz::factory(),
        ];
    }
}
