<?php

namespace Tests\Feature;

use App\Models\Module;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleQuizTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_creates_a_new_instance_for_current_user()
    {
        $user = User::factory()->create();
        $mod = Module::factory()->create(['title' => 'Acme Module']);
        $quiz = Quiz::factory()->for($mod)->create([
            'title' => 'Acme Module Assessment',
        ]);

        $this->actingAs($user)->get(route('module.quiz.show', ['module' => $mod->id]));

        $this->assertCount(1, $user->quizzes);
        $this->assertDatabaseHas('quiz_instances', [
            'id' => 1,
            'quiz_id' => $quiz->id,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    function it_persists_the_quiz_instance_when_answer_submitted()
    {
        $user = User::factory()->create();
        $mod = Module::factory()->create(['title' => 'Acme Module']);
        $quiz = Quiz::factory()->for($mod)->hasQuestions(2, [
            'answer' => 'ABC',
        ])->create([
            'title' => 'Acme Module Assessment',
        ]);

        $user->quizzes()->attach($quiz->id);

        $this->assertDatabaseCount('quiz_instances', 1);

        $response = $this->actingAs($user)->post(route('quiz.check', ['quiz' => $quiz->id]), [
            'answer' => 'ABC',
            'questionId' => 1,
            'instanceId' => 1,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('module.quiz.show', ['module' => $mod->id]));

        $this->followRedirects($response)->assertSuccessful();

        $this->assertDatabaseHas('quiz_instances', [
            'id' => 1,
            'quiz_id' => $quiz->id,
            'user_id' => $user->id,
            'current_question_id' => 2,
        ]);
    }
}
