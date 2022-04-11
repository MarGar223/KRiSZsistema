@extends('index')

@section('content')





    <div class="cotnainer-fluid">
        <p class="fs-3 fw-bold text-center mt-3">
            Visi vartotojai
        </p>
        <div class="d-flex justify-content-center">
            @if ($users->count())
                <table class="table table-striped table-success table-hover p-4 mt-4 w-75">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Vardas, Pavardė</th>
                            <th scope="col">Pareigos</th>
                            <th scope="col">El. pašto adresas</th>
                            <th scope="col">Vartotojo lygis</th>
                            @if (auth()->user())
                                @if (auth()->user()->level == 'Admin')
                                    <th scope="col">Funkcijos</th>
                                @endif
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-center">
                                <td>{{ $user->name }} {{ $user->surname }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->level }}</td>
                                @if (auth()->user())
                                    @if (auth()->user()->level == 'Admin' || auth()->user()->level == 'Instructor' || auth()->user()->id == $reservation->user_id)
                                        <td>
                                            <div class="btn-group dropend">
                                                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i data-feather="settings" class="text-dark"></i>
                                                </a>
                                                <ul class="dropdown-menu bg-light py-1"
                                                    aria-labelledby="dropdownMenuLink">
                                                    <li class="text-center">
                                                        <form action="{{ route('editUser', $user) }}" action="GET">
                                                            @csrf
                                                            <button type="submit" class="btn-sm btn-success align-middle border-0 w-75" title="Redaguoti"><i data-feather="edit"></i> Redaguoti </button>
                                                        </form>
                                                    </li>
                                                    <li class="text-center">
                                                        <form action="" action="GET">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn-sm btn-danger align-middle border-0 w-75 mt-1" title="Trinti"><i data-feather="trash-2"></i> Trinti </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="fs-3 fw-bold text-center mt-3">
                    Vartotojų nėra
                </p>
            @endif
        </div>

    @endsection
