@extends('layouts.app')

<ul>
  @foreach ($modules as $mod)
    <li>
      <span>{{ $mod->title }} -</span>
      <a href="{{ route('module.quiz.show', ['module' => $mod->id] ) }}">{{ $mod->quiz->title }}</a>
    </li>
  @endforeach
</ul>