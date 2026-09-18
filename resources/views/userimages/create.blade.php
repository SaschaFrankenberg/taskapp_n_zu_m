<x-layout title="Bild Upload">
    <h2>Bildupload für den Benutzer {{ $user->name }}</h2>

    <form method="post" action="{{ route('userimages.store', $user) }}" enctype="multipart/form-data">
        @csrf
        <label for="alt">Alternativ Text</label><br>
        <input type="text" name="alt" id="alt" value="{{ old('alt') }}">
        @error('alt') {{ $message }}  @enderror

        <label for="image">Bildauswahl</label><br>
        <input type="file" name="image" id="image">
        @error('image'){{ $message }} @enderror
        <br><br>
        <button type="submit">Speichern</button>
        <a href="{{ route('userimages.index') }}">Abbrechen</a>
    </form>
</x-layout>
