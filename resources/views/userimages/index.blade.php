<x-layout title="Benutzer">
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th>
                    <label>
                        <input type="checkbox" class="checkbox"/>
                    </label>
                </th>
                <th>Bild</th>
                <th>Name</th>
                <th>E-Mail</th>
            </tr>
            </thead>
            <tbody>
            <!-- row 1 -->
            @foreach($users as $user)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle h-12 w-12">
                                    @if($user->imagepath)
                                        <img
                                            src="https://img.daisyui.com/images/profile/demo/2@94.webp"
                                            alt="Avatar Tailwind CSS Component"/>
                                    @else
                                        <a href="{{ route('userimages.create', $user) }}">Bild hochladen</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
