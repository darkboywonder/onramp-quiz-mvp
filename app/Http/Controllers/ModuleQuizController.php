<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleQuizController extends Controller
{
    public function show(Module $module)
    {
        $user = auth()->user();
        $quiz = $user->quizzes()->find($module->quiz->id);

        // if no quiz instance found for user, create one
        if (! $quiz) {
            $user->quizzes()->attach($module->quiz->id);
            $quiz = $user->quizzes()->find($module->quiz->id);
        }

        return view('module.quiz.show', [
            'quiz' => $module->quiz,
            'instance' => $quiz->instance,
        ]);
    }
}
