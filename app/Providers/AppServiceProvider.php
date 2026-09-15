<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin-view', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('task-view', function (User $user, Task $task) {                       // Übergibt ein Task dem User
//            return $user->id === $task->user_id ? Response::allow() : Response::denyAsNotFound(); // Gibt automatisch die 404 Fehlerseite zurück / Sicherheit
            return true;
        });
    }
}
