<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TaskController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

Route::get('/dbtest', function () {
    //    $users = DB::table('users')->get();           // Collections
    //    $users = DB::select('SELECT * FROM users');   // Array
    $users = User::get();
    $users_id = $users->pluck('id')->toArray();     // pluck macht eine Collection ->toArray wandelt es in ein Array um
    $id = Arr::random($users_id);
    //    return dump($id);
    //    return $users;
    return fake()->address();
});

//Einzige öffentlicher View
Route::view('/', 'welcome')->name('welcome'); // Kurzschreibform


Route::middleware('auth')->group(function () {
    //Tasks
    // Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    // Route::get('/tasks/{task}', [TaskController::class,'show'])->whereNumber('task')->name('tasks.show');
    // Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    // Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    // Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    // Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    // Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
    Route::resource('tasks', TaskController::class);

    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/notifications/{id}', function ($id) {
        $notification = auth()->user()->unreadNotifications->firstWhere('id', $id);
        $notification->markAsRead();
        return back();
    });
});


Route::middleware('guest')->group(function () {
    //Registrierung
    Route::get('/register', [RegistrationController::class, 'create'])->name('register');
    Route::post('/register', [RegistrationController::class, 'store']);

    //Session
    Route::get('/login', [SessionController::class, 'create'])->name('login'); // Wichtig für Weiterleitung (name)
    Route::post('/login', [SessionController::class, 'store']);
});
