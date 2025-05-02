@extends('layouts.app')

@section('title', "Task: $task->title ")



@section('content')
    <p> Description: {{ $task->description }} </p>

    @if ($task->long_description)
        <p> Full Description: {{ $task->long_description }} </p>
    @endif

    <p> Status:
        @if ($task->completed)
            <span style="color: green;">Completed</span>
        @else
            <span style="color: red;">Not Completed</span>
        @endif
    </p>

    <p> Created at: {{ $task->created_at }} </p>
    <p> Updated at: {{ $task->updated_at }} </p>
@endsection
