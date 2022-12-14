@extends('layouts.app')

@foreach ($quiz->questions as $question)
  @if ($instance->current_question_id === $question->id)
  <section>
    <p>{{ $question->text }}</p>
    <code>
        <form method="post" action="{{ route('git-branch-test.check') }}">
            @csrf
            <input name="userAnswer" type="text" />
            <button type="submit">Submit</button>
        </form>
    </code>
  </section>
  @endif
@endforeach