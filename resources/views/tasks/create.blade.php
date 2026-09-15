<x-layout title="Neue Aufgabe">

    <div class="mx-auto max-w-xl">
        <h1> Neue Aufgabe! </h1>

        <form action="{{ route('tasks.store') }}" method="POST"
            class="mt-6 space-y-4 rounded-box border border-base-300 bg-base-100 p-6 shadow-sm">
            @csrf

            <fieldset class="fieldset">
                <legend>Titel</legend>
                <input id="title" type="text" name="title" value="{{ old('title') }}"
                    class="input w-full {{ $errors->has('title') ? 'input-error' : '' }}">
                    @error('title') {{ $message }} @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend>Beschreibung</legend>
                <textarea id="description" name="description" rows="4"
                    class="textarea w-full {{ $errors->has('description') ? 'textarea-error' : '' }}">{{ old('description') }}</textarea>
                @error('description') {{ $message }} @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend>User</legend>
                <select name="user[]" id="user" multiple class="border">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user') {{ $message }} @enderror
            </fieldset>

            <button type="submit" class="btn btn-primary">Aufgabe anlegen</button>
        </form>
    </div>
</x-layout>
