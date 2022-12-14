<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GitTestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('git-test', function () {
    session()->put('git-test-status', [
        'question1' => 'attempting',
        'question2' => 'not started',
        'question3' => 'not started',
    ]);

    return redirect('/');
});

Route::get('/', function () {
    return view('test');
});

Route::post('git-clone-test', [GitTestController::class, 'cloneTestCheck'])->name('git-clone-test.check');
Route::post('git-branch-test', [GitTestController::class, 'branchTestCheck'])->name('git-branch-test.check');
Route::post('git-commit-test', [GitTestController::class, 'commitTestCheck'])->name('git-commit-test.check');
