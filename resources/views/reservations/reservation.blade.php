@extends('index')

@section('content')
<div class="container-fluid">
    <p class="fs-3 fw-bold text-center mt-3">Visos rezervacijos</p>

</div>
    <div class="d-flex justify-content-center p-4">
        @if ($reservations->count())
            <table class="table table-striped table-success table-hover px-4 mt-2 mx-3">
                <thead>
                    <tr class="text-center align-middle">
                        <th scope="col">Rezervacija atlikta</th>
                        <th scope="col">Rezervuotojas</th>
                        <th scope="col">Zona</th>
                        <th scope="col">Rezervuota data</th>
                        <th scope="col">Pradžios laikas</th>
                        <th scope="col">Pabaigos laikas</th>
                        <th scope="col">Asmenų skaičius</th>
                        @if (auth()->user())
                            <th scope="col">Funkcijos</th>
                        @endif

                    </tr>
                </thead>

                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr class="text-center">

                            <td>{{ $reservation->created_at->diffForHumans() }}</td>
                            <td>{{ $reservation->user->name }}</td>
                            <td>{{ $reservation->zone->name }}</td>
                            <td>{{ $reservation->date_when }}</td>
                            <td>{{ $reservation->start_time }}</td>
                            <td>{{ $reservation->end_time }}</td>
                            <td>{{ $reservation->people_count }}</td>

                            @if (auth()->user())
                                @if (auth()->user()->level == 'Admin' || auth()->user()->level == 'Instructor')
                                <td>
                                    <div class="btn-group dropend">
                                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i data-feather="settings" class="text-dark"></i>
                                        </a>
                                        <ul class="dropdown-menu bg-light py-1"
                                            aria-labelledby="dropdownMenuLink">
                                            <li class="text-center">
                                                <form action="{{ route('showReservation', $reservation) }}" action="GET">
                                                    @csrf
                                                    <button type="submit" class="btn-sm btn-success align-middle border-0 w-75" title="Redaguoti"><i data-feather="edit"></i> Redaguoti </button>
                                                </form>
                                            </li>
                                            <li class="text-center">
                                                <form action="{{ route('deleteReservation', $reservation) }}" action="GET">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn-sm btn-danger align-middle border-0 w-75 mt-1" title="Trinti"><i data-feather="trash-2"></i> Trinti </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                @else
                                @if (auth()->user()->id == $reservation->user_id)
                                <td>
                                    <div class="btn-group dropend">
                                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i data-feather="settings" class="text-dark"></i>
                                        </a>
                                        <ul class="dropdown-menu bg-light py-1"
                                            aria-labelledby="dropdownMenuLink">
                                            <li class="text-center">
                                                <form action="{{ route('showReservation', $reservation) }}" action="GET">
                                                    @csrf
                                                    <button type="submit" class="btn-sm btn-success align-middle border-0 w-75" title="Redaguoti"><i data-feather="edit"></i> Redaguoti </button>
                                                </form>
                                            </li>
                                            <li class="text-center">
                                                <form action="{{ route('deleteReservation', $reservation) }}" action="GET">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn-sm btn-danger align-middle border-0 w-75 mt-1" title="Trinti"><i data-feather="trash-2"></i> Trinti </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                @else
                                <td></td>

                                @endif
                                @endif

                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Rezervacijų nėra
            <p>
        @endif
    </div>
@endsection
