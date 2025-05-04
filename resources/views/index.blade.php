@extends('layouts.app')


@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Task List</h1>
        <div class="flex items-center space-x-4">
            <!-- Items per page selector -->
            <div class="flex items-center">
                <label for="per_page" class="mr-2 text-sm text-gray-600">Items per page:</label>
                <select id="per_page" onchange="updateItemsPerPage(this.value)"
                        class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>
            </div>

            <a href="{{ route('db.tasks.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add Task
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        @if(count($tasks) > 0)
            <ul class="divide-y divide-gray-200">
                @foreach($tasks as $task)
                    <li class="p-4 hover:bg-gray-50 transition duration-150">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <input type="checkbox" {{ $task->completed ? 'checked' : '' }}
                                           class="h-5 w-5 text-blue-600 rounded focus:ring-blue-500" disabled>
                                </div>
                                <div>
                                    <a href="{{ route('db.tasks.show', $task->id) }}"
                                        class="text-lg font-medium @if($task->completed) line-through text-gray-500 @else text-gray-800 hover:text-blue-600 @endif">
                                         {{ $task->title }}
                                         @if($task->completed)
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline ml-1 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                                 <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                             </svg>
                                         @endif
                                     </a>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ Str::limit($task->description, 50) }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('db.tasks.edit', $task->id) }}"
                                   class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                                <form action="{{ route('db.tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50"
                                            onclick="return confirm('Are you sure you want to delete this task?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <span>Created: {{ $task->created_at->diffForHumans() }}</span>
                            <span class="mx-2">•</span>
                            <span>Updated: {{ $task->updated_at->diffForHumans() }}</span>
                            <span class="mx-2">•</span>
                            <span>Status:
                                <span class="{{ $task->completed ? 'text-green-600' : 'text-yellow-600' }}">
                                    {{ $task->completed ? 'Completed' : 'Pending' }}
                                </span>
                            </span>

                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} tasks
                </div>
                <div>
                    {{ $tasks->appends(['per_page' => request('per_page')])->links() }}
                </div>
            </div>
        @else
            <div class="p-8 text-center">
                <p class="text-gray-500">No tasks found. Create your first task!</p>
                <a href="{{ route('db.tasks.create') }}"
                   class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Create Task
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    function updateItemsPerPage(value) {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', value);
        window.location.href = url.toString();
    }
</script>
@endsection
