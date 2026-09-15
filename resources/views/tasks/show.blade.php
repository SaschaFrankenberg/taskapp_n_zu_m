<x-layout title="{{ $task->title }}">



    <article class="card mt-4 bg-base-100 shadow-sm">
        <div class="card-body">
            <div class="flex items-center justify-between gap-4">
                <h1 class="text-2xl font-bold"> {{ $task->title }} </h1>
                <span class="badge {{$task->done ? 'badge-success' : 'badge-ghost' }} font-bold">
                    {{ $task->done ? 'Abgeschlossen' : 'offen' }}
                </span>
            </div>
            <p class="mt-6 leading-relaxed"> {{ $task->description }} </p>
            <br>
            <p>Zugewiesene Nutzer: </p>

            <ul>
                @foreach ($task->users as $user)
                    <li>{{ $user->name }}</li>
                @endforeach
            </ul>
        </div>
    </article>
</x-layout>