@extends('index')

@section('content')

    <div class="flex justify-center bg-yellow-600">
        <table class="text-lg bg-green-200 w-1/2 mt-7 rounded-lg">
            <thead class="border-b-2">
                <tr>
                    <th class="p-4">Vardas, Pavardė</th>
                    <th>Pareigos</th>
                    <th>El. pašto adresas</th>
                    <th class="p-4">Vartotojo lygis</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-500 px-4">
                @foreach ($users as $user)
                <tr>
                    <td class="p-4">{{ $user->name }} {{ $user->surname }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->level }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
