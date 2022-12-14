<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CheckQuizAnswerController extends Controller
{
    public function __invoke(Request $request, Quiz $quiz)
    {
        if (! $request->has(['questionId'])) {
            abort(422);
        }

        $question = $quiz->questions->find($request->input('questionId'));

        $request->validate([
            'answer' => ['required', Rule::in([$question->answer])],
        ]);

        // update the quiz instance
        if ($request->input('questionId') <= $quiz->questions->count()) {
            $quiz->instances()->updateExistingPivot(auth()->user()->id, [
                'current_question_id' => $request->input('questionId') + 1,
            ]);
        }

        return redirect()->route('module.quiz.show', ['module' => $quiz->module->id])->with('success', true);
    }
}
