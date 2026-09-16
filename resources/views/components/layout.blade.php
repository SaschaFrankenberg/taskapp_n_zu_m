@props(['title' => 'TaskApp'])

    <!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - TaskApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-base-200 text-base-content antialiased">
<x-nav/>
@auth
    <div class="card mt-6 bg-base-100 shadow-sm">
        <h2 class="text-center font-bold">Benachrichtigungen</h2>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <ul class="divide-y divide-base-200">
                @foreach(auth()->user()->unreadNotifications as $notification)
                    <li class="flex items-center gap-4 px-5 py-4"><a
                            href="{{ $notification->data['url'] }}"
                            class="underline hover:no-underline">{{ $notification->data['message'] }}
                            - {{ $notification->data['title'] }}</a></li>
                @endforeach
            </ul>
        @else
            <p>Keine Benachrichtigung</p>
        @endif
    </div>
@endauth
<main class="mx-auto max-w-5xl px-4 py-8">
    @if(session('success'))
        <div class="alert alert-success mb-6">
            {{ session('success') }}
        </div>
    @endif
    {{ $slot }}
</main>

</body>
</html>
