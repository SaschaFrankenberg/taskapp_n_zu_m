<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        //welche aufgaben hat der user
//        $tasks = $user->tasks()
////        ->when($request->filled('q'), function ($query) use($request){
////            $query->search($request->input('q'));
////                // dd($q->toRawSql());
////            })
////        ->latest()->get();
        $tasks = Task::all();

        //Task::where('user_id', $user->id)->latest()->get();

        return view('dashboard', ['user' => $user, 'tasks' => $tasks ]);
    }
}
