@extends('layouts.app')
@section('title', 'Home Page')

@section('content')
        <p>Welcome to the TaskList App!</p>

    <div>

        <h2>Latest Tasks</h2>
        @isset($tasks)
            <ul>
                @forelse($tasks as $task)
                    <a href="{{ route('single-task', ['id' => $task->id]) }}">
                        <li>{{ $task->title }}</li>
                    </a>
                @empty
                    <li>No tasks available.</li>
                @endforelse
            </ul>
        @endisset

    </div>

@endsection

