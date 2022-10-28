@extends('layouts.app')
@php
    dump(session('git-test-status'));
@endphp
<h1>Git Basics</h1>

@if (session('git-test-status.question1') !== 'not started')
    <section>
        <p>Clone `test-project`</p>
        <code>
            <form method="post" action="{{ route('git-clone-test.check') }}">
                @csrf
                <input name="userAnswer" type="text" />
                <button type="submit">Submit</button>
            </form>
        </code>
    </section>
@endif

@if (session('git-test-status.question2') !== 'not started')
    <section>
        <p>Create a new branch named `test-branch`</p>
        <code>
            <form method="post" action="{{ route('git-branch-test.check') }}">
                @csrf
                <input name="userAnswer" type="text" />
                <button type="submit">Submit</button>
            </form>
        </code>
    </section>
@endif

@if (session('git-test-status.question3') !== 'not started')
    <section>
        <p>create a commit with the message "test commit"</p>
        <code>
            <form method="post" action="{{ route('git-commit-test.check') }}">
                @csrf
                <input name="userAnswer" type="text" />
                <button type="submit">Submit</button>
            </form>
        </code>
    </section>
@endif

@if (session('success'))
    <p>Success!!</p>
@endif

@error('userAnswer')
    <p>Sorry, try again!</p>
@enderror
