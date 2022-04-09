@extends('index')

@section('content')

    <div class="d-flex justify-content-center">
        @if ($reservations->count())
            <table class="table table-striped table-dark table-hover p-4 mt-4 w-75">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Rezervacija atlikta</th>
                        <th scope="col">Rezervuotojas</th>
                        <th scope="col">Zona</th>
                        <th scope="col">Data</th>
                        <th scope="col">Pradžios laikas</th>
                        <th scope="col">Pabaigos laikas</th>
                        <th scope="col">Asmenų skaičius</th>
                        @if (auth()->user())
                            @if (auth()->user()->level == 'Admin' || auth()->user()->level == 'Instructor' || auth()->user()->id == $reservation->user_id)
                                <th scope="col">Funkcijos</th>
                            @endif
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
                                @if (auth()->user()->level == 'Admin' || auth()->user()->level == 'Instructor' || auth()->user()->id == $reservation->user_id)
                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('showReservation', $reservation) }}" action="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm mx-1">Redaguoti</button>
                                            </form>
                                            <form action="{{ route('deleteReservation', $reservation) }}" action="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Trinti</button>
                                            </form>
                                        </div>
                                    </td>
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
