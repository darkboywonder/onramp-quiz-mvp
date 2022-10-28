<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GitTestController extends Controller
{
    public function cloneTestCheck(Request $request)
    {
        $request->validate([
            'userAnswer' => ['required', Rule::in(['git clone test-project'])]
        ]);

        $request->session()->put('git-test-status.question1', 'success');
        $request->session()->put('git-test-status.question2', 'attempting');

        return back()->with('success', true);
    }

    public function branchTestCheck(Request $request)
    {
        $request->validate([
            'userAnswer' => ['required', Rule::in(['git checkout -b test-branch'])]
        ]);

        $request->session()->put('git-test-status.question2', 'success');
        $request->session()->put('git-test-status.question3', 'attempting');

        return back()->with('success', true);
    }

    public function commitTestCheck(Request $request)
    {
        $request->validate([
            'userAnswer' => ['required', Rule::in(['git commit -m"test commit"', 'git commit -am"test commit"', 'git commit -m "test commit"', 'git commit -am "test commit"'])]
        ]);

        $request->session()->put('git-test-status.question3', 'success');

        return back()->with('success', true);
    }
}
