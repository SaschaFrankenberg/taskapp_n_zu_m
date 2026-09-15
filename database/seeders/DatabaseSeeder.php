<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();
        // Ids ermitteln und in Array legen
        $users_id = $users->pluck('id')->toArray();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

//        $tasks = [
//            ['title' => 'IT Basics', 'description' => 'Grundlegende Programmierung', 'done' => true],
//            ['title' => 'Laravel Basics', 'description' => 'Routing und Controller in Laravel', 'done' => true],
//            ['title' => 'Java Basics', 'description' => 'Grundlegende Java-Konzepte', 'done' => true],
//            ['title' => 'It Professionels', 'description' => 'Vertiefung Programmierung allgemein', 'done' => true],
//            ['title' => 'Laravel Professionels', 'description' => 'Vertiefung Laravel', 'done' => true],
//            ['title' => 'Java Professionels', 'description' => 'Vertiefung Java', 'done' => true],
//
//            ['title' => 'Zugriffe in Laravel', 'description' => 'Authorisierung und Gruppierung in Laravel', 'done' => false],
//        ];
//
//        foreach ($tasks as $task)
//            Task::create($task);

    }
}
