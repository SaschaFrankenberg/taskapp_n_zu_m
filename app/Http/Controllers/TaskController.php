<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::latest()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->search($request->input('q'));
            })
            ->when($request->input('status') === 'open', function ($query) {
                $query->where('done', false);
            })
            ->when($request->input('status') === 'done', function ($query) {
                $query->where('done', true);
            })
            ->paginate(5)->withQueryString();
        return view('tasks.index', ['tasks' => $tasks]); // Pfadstrukturen mit . nicht mit /
    }

    public function show(Task $task)
    {
        $task->load('users');
        return view('tasks.show', compact('task'));  //return view('tasks.show', ['task' => $task]);
    }

    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
//        dd($request->user);
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:500'],
            'user' => ['required'],
        ]);
//        $validated['user_id'] = auth()->id(); // Der aktuell eingeloggte User
        $validated['done'] = false;

        $task = Task::create($validated);
        // für das Schreiben in die Zwischentabelle mit Eloquent
        $task->users()->attach($request->user);

        return redirect()->route('dashboard')->with('success', 'Aufgabe erfolgreich angelegt');
    }

    public function edit(Task $task)
    {
        // muss in edit, update, destroy und toggle, da sonst gefälschte anfragen durchgehen würden
//        abort_if($task->user_id !== auth()->id(), 404);
        Gate::authorize('task-view', $task); // $task ist die zugewiesene Aufgabe für den eingeloggten User
        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        Gate::authorize('task-view', $task);
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:500']
        ]);

        $task->update($validated);

        return redirect()->route('tasks.show', $task)->with('success', 'Aufgabe aktualisiert');
    }

    public function destroy(Task $task)
    {
//        abort_if($task->user_id !== auth()->id(), 404);
        Gate::authorize('task-view', $task);
        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Aufgabe gelöscht');
    }


    public function toggle(Task $task)
    {
        //nur der Ersteller darf seine Aufgabe umschalten
//        abort_if($task->user_id !== auth()->id(), 403);
        Gate::authorize('task-view', $task);
        $task->done = !$task->done;
        $task->save();

        $message = $task->done ? 'Aufgabe erledigt' : 'Aufgabe wieder geöffnet';

        return back()->with('success', $message);

    }
}
