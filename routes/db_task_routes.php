<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;

// Index - List all tasks from DB
Route::get('/db/tasks', function () {
    $perPage = request('per_page', 5); // Default to 5 if not specified
    return view('index', ['tasks' => Task::latest()->paginate($perPage)]);
})->name('db.tasks.list');



// Create Form
Route::get('/db/tasks/create', function () {
    return view('create');
})->name('db.tasks.create');


// Show - Single task from DB
Route::get('/db/tasks/{id}', function ($id) {
    return view('singleTask', ['task' => Task::findOrFail($id)]);
})->name('db.tasks.show');


// Store - Save new task to DB
Route::post('/db/tasks', function (Request $request) {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'long_description' => 'nullable|string',
    ]);

    $task = Task::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'long_description' => $validated['long_description'],
        'completed' => $request->has('completed'),
    ]);

    return redirect()->route('db.tasks.show', $task->id)
        ->with('success', 'Task created successfully!');
})->name('db.tasks.store');

// Edit Form
Route::get('/db/tasks/{task}/edit', function (Task $task) {
    return view('edit', ['task' => $task]);
})->name('db.tasks.edit');

// Update - Update task in DB
Route::put('/db/tasks/{task}', function (Request $request, Task $task) {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'long_description' => 'nullable|string',
        'completed' => 'boolean',
    ]);

    $task->update($validated);

    return redirect()->route('db.tasks.show', $task->id)
        ->with('success', 'Task updated successfully!');
})->name('db.tasks.update');

// Delete - Remove task from DB
Route::delete('/db/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('db.tasks.list')
        ->with('success', 'Task deleted successfully!');
})->name('db.tasks.destroy');
