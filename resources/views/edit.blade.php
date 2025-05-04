@extends('layouts.app')
@section('title', 'Edit Task')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Edit Task</h1>

    <form method="POST"
          action="{{ isset($task->id) ? route('db.tasks.update', $task->id) : route('tasks.update', $task->id) }}"
          class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title*</label>
            <input type="text" id="title" name="title" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   value="{{ old('title', $task->title) }}">
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description*</label>
            <textarea id="description" name="description" rows="3" required
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="long_description" class="block text-sm font-medium text-gray-700">Detailed Description</label>
            <textarea id="long_description" name="long_description" rows="5"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('long_description', $task->long_description) }}</textarea>
            @error('long_description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <input type="hidden" name="completed" value="0"> <!-- Important for unchecked state -->
            <input type="checkbox" id="completed" name="completed" value="1"
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                   {{ old('completed', $task->completed) ? 'checked' : '' }}>
            <label for="completed" class="ml-2 block text-sm text-gray-700">Completed</label>
            @error('completed')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ isset($task->id) ? route('db.tasks.show', $task->id) : route('tasks.show', $task->id) }}"
               class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Update Task
            </button>
        </div>
    </form>

    @if(isset($task->id) && Route::has('db.tasks.destroy'))
    <div class="mt-6 pt-6 border-t border-gray-200">
        <form method="POST" action="{{ route('db.tasks.destroy', $task->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-4 py-2 bg-red-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                    onclick="return confirm('Are you sure you want to delete this task?')">
                Delete Task
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
