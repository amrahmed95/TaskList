<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed,
        public string $created_at,
        public string $updated_at
    ) {
    }
}

$taskList = [
    new Task(1, 'Buy groceries', 'Purchase essentials for the week.', 'Milk, eggs, bread, fresh fruits, and vegetables from the local market.', false, '2023-03-01 09:00:00', '2023-03-01 09:00:00'),
    new Task(2, 'Sell old stuff', 'List old electronics and clothes for sale online.', 'Take photos and write descriptions for items like an old laptop, jackets, and shoes.', false, '2023-03-02 10:30:00', '2023-03-02 10:30:00'),
    new Task(3, 'Learn programming', 'Complete online tutorials on Python basics.', 'Focus on understanding loops, functions, and object-oriented programming.', true, '2023-03-03 14:15:00', '2023-03-10 18:00:00'),
    new Task(4, 'Take dogs for a walk', 'Walk the dogs around the neighborhood.', null, false, '2023-03-04 07:00:00', '2023-03-04 07:00:00'),
    new Task(5, 'Read a book', 'Finish reading the new novel by favorite author.', 'Aim to read at least 50 pages before the weekend.', false, '2023-03-05 20:00:00', '2023-03-05 20:00:00'),
    new Task(6, 'Go to the gym', 'Attend strength training session.', null, true, '2023-03-06 17:30:00', '2023-03-06 19:00:00'),
    new Task(7, 'Finish homework', 'Complete math and science assignments due Monday.', 'Review formulas and write detailed answers for each question.', false, '2023-03-07 16:00:00', '2023-03-07 16:00:00'),
    new Task(8, 'Plan vacation', 'Research destinations and accommodation options.', null, false, '2023-03-08 11:45:00', '2023-03-08 11:45:00'),
    new Task(9, 'Clean the house', 'Deep clean kitchen and bathroom.', 'Mop floors, clean countertops, and organize cabinets.', true, '2023-03-09 09:00:00', '2023-03-09 12:00:00'),
    new Task(10, 'Attend meeting', 'Join the project planning meeting at 3 PM.', null, false, '2023-03-10 14:00:00', '2023-03-10 14:00:00'),
    new Task(11, 'Write a blog post', 'Draft article on healthy lifestyle tips.', 'Include sections on nutrition, exercise, and mental wellness.', false, '2023-03-11 19:00:00', '2023-03-11 19:00:00'),
    new Task(12, 'Cook dinner', 'Prepare a vegetarian pasta dish.', null, true, '2023-03-12 18:00:00', '2023-03-12 19:00:00'),
    new Task(13, 'Grocery shopping', 'Stock up on household supplies.', 'Buy cleaning products, snacks, and beverages.', false, '2023-03-13 10:00:00', '2023-03-13 10:00:00'),
    new Task(14, 'Visit family', 'Spend the afternoon with relatives.', null, false, '2023-03-14 13:00:00', '2023-03-14 13:00:00'),
    new Task(15, 'Watch a movie', 'Watch the newly released thriller.', 'Invite friends over and prepare popcorn.', true, '2023-03-15 20:30:00', '2023-03-15 22:30:00'),
    new Task(16, 'Go for a bike ride', 'Cycle around the park for fitness.', null, false, '2023-03-16 07:30:00', '2023-03-16 07:30:00'),
    new Task(17, 'Organize files', 'Sort and archive digital documents.', 'Delete duplicates and create backup folders on the cloud.', false, '2023-03-17 15:00:00', '2023-03-17 15:00:00'),
    new Task(18, 'Attend workshop', 'Participate in online marketing workshop.', null, true, '2023-03-18 09:00:00', '2023-03-18 12:00:00'),
    new Task(19, 'Meditate', 'Practice mindfulness meditation for 20 minutes.', 'Focus on breathing and clearing the mind.', false, '2023-03-19 06:30:00', '2023-03-19 06:30:00'),
    new Task(20, 'Fix bike', 'Repair the flat tire and oil the chain.', null, false, '2023-03-20 11:00:00', '2023-03-20 11:00:00'),
    new Task(21, 'Update resume', 'Add recent work experience and skills.', 'Tailor resume for upcoming job applications.', false, '2023-03-21 16:45:00', '2023-03-21 16:45:00'),
    new Task(22, 'Renew subscription', 'Renew the annual subscription for cloud storage.', null, true, '2023-03-22 10:00:00', '2023-03-22 10:15:00'),
];

// Index - List all tasks
// localhost:8000/tasks
Route::get('/tasks', function () use ($taskList) {
    return view('index', ['tasks' => $taskList]);
})->name('tasks.list');


// Show - Single task
// localhost:8000/tasks/1
Route::get('tasks/{id}', function ($id) use ($taskList) {
    $task = collect($taskList)->firstWhere('id', $id);
    if(!$task) {
        abort(self::Response::HTTP_NOT_FOUND);
    }
    return view('singleTask', ['task' => $task]);
})->name('tasks.show');


// Create Form
Route::get('/tasks/create', function () {
    return view('create');
})->name('tasks.create');


// Store - Save new task (would need to implement array manipulation)
Route::post('/tasks', function () {
    // Implementation would need session or other storage
    // since we can't modify the $taskList directly
    abort(501, 'Not implemented for manual task list');
})->name('tasks.store');


// Edit Form (would need similar implementation as create)
Route::get('/tasks/{id}/edit', function ($id) use ($taskList) {
    $task = collect($taskList)->firstWhere('id', $id);
    if(!$task) {
        abort(self::Response::HTTP_NOT_FOUND);
    }
    return view('edit', ['task' => $task]);
})->name('tasks.edit');


// Update - Update task
Route::put('/tasks/{id}', function ($id) {
    abort(501, 'Not implemented for manual task list');
})->name('tasks.update');

// Delete - Remove task
Route::delete('/tasks/{id}', function ($id) {
    abort(501, 'Not implemented for manual task list');
})->name('tasks.destroy');

