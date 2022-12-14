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
        // just temp manually authenticate user if none
        if (! auth()->user()) {
            Auth::login(User::first());
        }

        $quiz = auth()->user()->quizzes()->find($module->quiz->id);

        // if no quiz instance found for user, create one
        if (! $quiz) {
            $quiz = auth()->user()->quizzes()->attach($module->quiz->id);
        }

        return view('module.quiz.show', [
            'quiz' => $module->quiz,
            'instance' => $quiz->instance,
        ]);
    }
}
