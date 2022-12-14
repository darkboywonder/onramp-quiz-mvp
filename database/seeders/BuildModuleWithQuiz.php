<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class BuildModuleWithQuiz extends Seeder
{
    public function run()
    {
        $quiz = Quiz::factory()->for(
            Module::factory()->state([
                'title' => 'Build A Basic Website',
            ])
        )->create([
            'title' => 'Build A Basic Website Assessment',
        ]);

        Question::factory()
        ->count(3)
        ->for($quiz)
        ->state(new Sequence(
            ['text' => 'Type the HTML element used to create the largest heading:', 'answer' => '<h1>'],
            ['text' => 'What does CSS stand for?', 'answer' => 'cascading style sheets'],
            ['text' => 'Using JS add the text "Hello World" to a div with an id of "text"', 'answer' => 'document.getElementById("text").innerHTML = "Hello World"'],
        ))
        ->create();
    }
}
