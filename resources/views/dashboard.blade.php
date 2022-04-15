@extends('index')

@section('content')
    <div class="container">
        @auth
            <div class="row">
                <div class="col-6">
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
                            {{ $reservations->links('vendor.pagination.bootstrap-5', ['uri' => $uri]) }}
                        </div>
                    @endauth
                </div>
                <div class="col-6 bg-success">
                    <div>
                        <p class="text-center pt-4 fs-3">Mano užrašai</p>
                        @auth
                            @foreach ($notes as $note)
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
                            <div>
                                {{ $notes->links('vendor.pagination.bootstrap-5', ['uri' => $uri]) }}
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        @endauth

        @guest
            <div class="container py-4">
                <div class="p-5 mb-4 bg-light rounded-3">
                    <div class="container-fluid py-5">
                        <h1 class="display-5 fw-bold">Sveiki atvykę!</h1>
                        <p class="col-md-8 fs-4">Jūs įsijungėte Kovinio rengimo ir sporto zonų rezervacijos sistemą, trumpiau -
                            <span class="fw-bold">KRiSZ</span>. Ši sistema skirta palengvinti zonų rezervacijas, kad jų
                            išnaudojimas būtų kuo efektyvesnis!
                        </p>
                        <p class="col-md-8 fs-5">Norint pradėti naudotis KRiSZ prisijunkite su jau turima paskyra.</p>
                        <p class="col-md-8 fs-6 text-muted">Neturint paskyros susisiekite su sistemos administratoriumi.</p>

                    </div>
                </div>

                <div class="row align-items-md-stretch">
                    <div class="col-md-6">
                        <div class="h-100 p-5 text-white bg-dark rounded-3">
                            <h2>Naujienos</h2>
                            <p> KRiSZ sistema yra tobulinama kiekvieną dieną. Apie visas pastabas, pastebėjimus ar patobulinimus
                                praneškite sistemos adminsitratoriui.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="h-100 p-5 bg-light border rounded-3">
                            <h2>Naujausia rezervacija</h2>
                            @if ($reservation)
                                <p>
                                <div class="card my-4 shadow">
                                    <p class="card-header">
                                        Rezervacija atlikta <span
                                            class="text-sm">{{ $reservation->created_at->diffForHumans() }}</span>
                                    </p>
                                    <div class="card-body">
                                        <p class="card-text">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-6">
                                                    Rezervuota zona:
                                                </div>
                                                <div class="col-6">
                                                    {{ $reservation->zone->name }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    Rezervuota data:
                                                </div>
                                                <div class="col-6">
                                                    {{ $reservation->date_when }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    Rezervuotas laikas:
                                                </div>
                                                <div class="col-6">
                                                    nuo {{ $reservation->start_time }} iki {{ $reservation->end_time }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    Rezervuota:
                                                </div>
                                                <div class="col-6">
                                                    {{ $reservation->people_count }} @if ($reservation->people_count === 1)
                                                        asmeniui
                                                    @else
                                                        asmenims
                                                    @endif
                                                </div>
                                            </div>
                                            </p>
                                            </p>
                                        @else
                                            <p>
                                            <div class="card my-4 shadow">
                                                <p class="card-header">
                                                    Rezervacijų nėra
                                                </p>
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        Sukurkite rezervaciją prisijungiant prie sistemos.
                                                    </p>
                                                    </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endguest
    </div>


@endsection
