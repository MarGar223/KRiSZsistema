@extends('index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="text-center pt-4 fs-3">Mano rezervacijos</p>
                @auth
                    @foreach ($reservations as $reservation)
                        <div class="card my-4">
                            <p class="card-header">
                                Rezervacija atlikta <span
                                    class="text-sm">{{ $reservation->created_at->diffForHumans() }}</span>
                            </p>
                            <div class="card-body">
                                <p class="card-text">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-4">
                                            Rezervuota zona:
                                        </div>
                                        <div class="col-8">
                                            {{ $reservation->zone->name }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            Rezervuota data:
                                        </div>
                                        <div class="col-8">
                                            {{ $reservation->date_when }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            Rezervuotas laikas:
                                        </div>
                                        <div class="col-8">
                                            nuo {{ $reservation->start_time }} iki {{ $reservation->end_time }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            Rezervuota:
                                        </div>
                                        <div class="col-8">
                                            {{ $reservation->people_count }} @if ($reservation->people_count === 1)
                                                asmeniui
                                            @else
                                                asmenims
                                            @endif
                                        </div>
                                    </div>
                                    </p>

                                    <div class="d-inline-flex">
                                        @if (auth()->user()->id == $reservation->user_id)
                                            <form action="{{ route('showReservation', $reservation) }}" action="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm mx-1">Redaguoti</button>
                                            </form>
                                            <form action="{{ route('deleteReservationFromDashboard', $reservation) }}"
                                                action="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm mx-1">Trinti</button>
                                            </form>
                                        @endif
                                    </div>

                                </div>


                            </div>
                        </div>
                    @endforeach
                    <div>
                        {{ $reservations->links() }}
                    </div>
                @endauth
            </div>
            <div class="col bg-success">
                <div>
                    <p class="text-center pt-4 fs-3">Mano užrašai</p>
                    @auth
                        @foreach ($user->notes as $note)
                            <div class="card my-4">
                                <div class="card-header ">
                                    Užrašas sukurtas <span
                                        class="text-sm">{{ $note->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $note->title }}</h5>
                                    <p class="card-text">{{ $note->body }}</p>

                                </div>
                            </div>
                        @endforeach
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
