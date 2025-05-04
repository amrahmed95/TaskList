<?php

use Illuminate\Support\Facades\Route;

// Homepage redirect
Route::get('/', function () {
    return redirect()->route('tasks.list');
})->name('home');

// Include manual task list routes
require __DIR__.'/task_list_routes.php';

// Include database task routes
require __DIR__.'/db_task_routes.php';

// Fallback route
Route::fallback(function () {
    return response()->json(['message' => 'Not Found'], 404);
});
