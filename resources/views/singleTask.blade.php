@extends('layouts.app')
@section('title', "Task: $task->title")

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $task->title }}</h1>
                    <div class="mt-2 flex items-center">
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                                    {{ $task->completed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $task->completed ? 'Completed' : 'Pending' }}
                        </span>
                        <span class="ml-4 text-sm text-gray-500">
                            Created: {{ $task->created_at->format('M d, Y h:i A') }}
                        </span>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('db.tasks.edit', $task->id) }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('db.tasks.destroy', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 flex items-center"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-medium text-gray-800">Description</h2>
                <p class="mt-2 text-gray-700 whitespace-pre-line">{{ $task->description }}</p>
            </div>

            @if($task->long_description)
            <div class="mt-6">
                <h2 class="text-lg font-medium text-gray-800">Detailed Description</h2>
                <p class="mt-2 text-gray-700 whitespace-pre-line">{{ $task->long_description }}</p>
            </div>
            @endif

            <div class="mt-6 pt-6 border-t border-gray-200 flex justify-between">
                <div class="text-sm text-gray-500">
                    Last updated: {{ $task->updated_at->diffForHumans() }}
                </div>
                <a href="{{ route('db.tasks.list') }}"
                   class="text-blue-600 hover:text-blue-800">
                    ← Back to all tasks
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
