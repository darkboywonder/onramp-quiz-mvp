@extends('layouts.app')

@foreach ($quiz->questions as $question)
  @if ($instance->current_question_id >= $question->id)
  <section>
    <p>{{ $question->text }}</p>

    <code>
      <form method="post" action="{{ route('quiz.check', ['quiz' => $quiz]) }}">
        @csrf

        @if ($instance->current_question_id === $question->id)
          <input name="answer" type="text" />
          <input name="questionId" type="hidden" value="{{ $question->id }}"/>
          <button type="submit">Submit</button>
        @else
          <div style="display: flex; flex-flow: row wrap; align-items: center; font-size: 1rem;">
            <code>{{ $question->answer }}</code>
            <p style="color: green; margin-left: 10px;">Correct!</p>
          </div>
        @endif
      </form>
    </code>
  </section>
  @endif
@endforeach

@error('answer')
  <p>Sorry, try again.</p>
@enderror