@extends('index')

@section('content')
    <div class="container">
        @auth
            <div class="row">
                @if ($errors->any())
                    <div class="bg-danger text-white text-center fs-6 rounded-pill p-3 mt-3 align-middle">
                        Operacijoje įvyko klaida
                    </div>
                @endif

                @if (session('status'))
                    <div class="bg-danger text-white text-center fs-6 rounded-pill p-3 mt-3 align-middle">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="bg-success text-white text-center fs-6 rounded-pill p-3 mt-3 align-middle">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="col-6">
                    <p class="text-center pt-4 fs-3 text-white">Mano rezervacijos</p>
                    @auth
                        @if ($reservations->count())
                            @foreach ($reservations as $reservation)
                                <div class="card my-4">
                                    <p class="card-header">
                                        Rezervacija atlikta <span
                                            class="text-sm">{{ $reservation->updated_at->diffForHumans() }}</span>
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
                                                    <button type="submit" class="btn btn-success btn-sm mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#resModalRed{{ $reservation->id }}">Redaguoti</button>
                                                    <button type="submit" class="btn btn-danger btn-sm mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#resModal{{ $reservation->id }}">Trinti</button>
                                                @endif
                                            </div>

                                        </div>


                                    </div>
                                </div>

                                {{-- Rezervacijos Modal redagavimo --}}
                                <form action="{{ route('editReservationFromDashboard', $reservation) }}" method="POST">
                                    @csrf
                                    <div class="modal fade" id="resModalRed{{ $reservation->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="false">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Rezervacijos
                                                        trinimas</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="zone" class="form-label">Zona</label>
                                                        <select name="zone" id="zone{{ $reservation->id }}"
                                                            value="{{ $reservation->name }}"
                                                            class="form-select  shadow-sm @error('zone') border border-danger text-danger @enderror">
                                                            <option value="{{ $reservation->zone_id }}" id="zone_id" selected>
                                                                {{ $reservation->zone->name }}
                                                            </option>
                                                            @foreach ($zones as $zone)
                                                                @if ($reservation->zone_id == $zone->id)
                                                                @else
                                                                    <option value="{{ $zone->id }}"
                                                                        id="zone_id{{ $zone->id }}">
                                                                        {{ $zone->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('zone')
                                                            <div class="fs-6 text-danger">
                                                                <span>Lauką privaloma užpildyti</span>
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="date" class="form-label">Data</label>
                                                        <input type="text" name="date_when" id="date_when{{ $reservation->id }}"
                                                            value="{{ $reservation->date_when }}"
                                                            class="form-control shadow-sm @error('date_when') border border-danger text-danger @enderror datepicker"
                                                            placeholder="Pasirinkite datą">
                                                        @error('date_when')
                                                            <div class="fs-6 text-danger">
                                                                <span>Lauką privaloma užpildyti</span>
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="start_time" class="form-label">Laikas
                                                            nuo</label>
                                                        <input name="start_time" id="start_time{{ $reservation->id }}"
                                                            value="{{ $reservation->start_time }}"
                                                            class="form-control shadow-sm @error('start_time') border border-danger text-danger @enderror timepicker"
                                                            placeholder="Pasirinkite laiką">
                                                        @error('start_time')
                                                            <div class="fs-6 text-danger">
                                                                <span>Lauką privaloma užpildyti</span>
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="end_time" class="form-label">Laikas iki</label>
                                                        <input name="end_time" id="end_time{{ $reservation->id }}"
                                                            value="{{ $reservation->end_time }}"
                                                            class="form-control shadow-sm @error('end_time') border border-danger text-danger @enderror timepicker"
                                                            placeholder="Pasirinkite laiką">
                                                        @error('end_time')
                                                            <div class="fs-6 text-danger">
                                                                <span>Lauką privaloma užpildyti</span>
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">

                                                        <label for="people_count" class="form-label">Žmonių
                                                            skaičius</label>
                                                        <input type="number" name="people_count"
                                                            id="people_count{{ $reservation->id }}"
                                                            value="{{ $reservation->people_count }}"
                                                            class="form-control shadow-sm @error('end_time') border border-danger text-danger @enderror">
                                                        @error('people_count')
                                                            <div class="fs-6 text-danger">
                                                                <span>Lauką privaloma užpildyti</span>
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Redaguoti</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Uždaryti</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                                {{-- Rezervacijos Modal trinimo --}}
                                <form action="{{ route('deleteReservationFromDashboard', $reservation) }}" method="GET">
                                    @csrf
                                    <div class="modal fade" id="resModal{{ $reservation->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Rezervacijos
                                                        trinimas</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Ar tikrai norite ištrinti rezervaciją:

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
                                                                        nuo {{ $reservation->start_time }} iki
                                                                        {{ $reservation->end_time }}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        Rezervuota:
                                                                    </div>
                                                                    <div class="col-6">
                                                                        {{ $reservation->people_count }}
                                                                        @if ($reservation->people_count === 1)
                                                                            asmeniui
                                                                        @else
                                                                            asmenims
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Trinti</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Uždaryti</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                            <div>
                                <a class="link-info" href="{{ route('reservation') }}"> Daugiau rezervacijų...</a>
                            </div>
                        @else
                            <div>
                                <a class="link-info" href="{{ route('reservation') }}"> Susikurkite rezervacijų...</a>
                            </div>
                        @endif
                    @endauth
                </div>
                <div class="col-6">
                    <div>
                        <p class="text-center pt-4 fs-3 text-white">Mano užrašai</p>
                        @auth
                            @if ($notes->count())
                                @foreach ($notes as $note)
                                    <div class="card my-4">
                                        <div class="card-header ">
                                            Užrašas sukurtas <span
                                                class="text-sm">{{ $note->updated_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $note->title }}</h5>
                                            <p class="card-text">{{ $note->body }}</p>
                                            <div class="d-inline-flex">
                                                @if (auth()->user()->id == $note->user_id)
                                                    <button type="submit" class="btn btn-success btn-sm mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#noteModalRed{{ $note->id }}">Redaguoti</button>
                                                    <button type="submit" class="btn btn-danger btn-sm mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#noteModal{{ $note->id }}">Trinti</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal trinimo --}}
                                    <form action="{{ route('deleteNoteFromDashboard', $note) }}" method="GET">
                                        @csrf
                                        <div class="modal fade" id="noteModal{{ $note->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Užrašo
                                                            trinimas</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Ar tikrai norite ištrinti užrašą pavadinimu: <span
                                                            class="fw-bold text-decoration-underline">{{ $note->title }}</span>?
                                                        Jeigu
                                                        taip, spauskite mygtuką
                                                        Trinti, o jei ne - Uždaryti.
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Trinti</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Uždaryti</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    {{-- Modal redagavimo --}}

                                    <form action="{{ route('editNoteFromDashboard', $note) }}" method="POST">
                                        @csrf
                                        <div class="modal fade" id="noteModalRed{{ $note->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Užrašo
                                                            redagavimas</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            <label for="title" class="form-label">Užrašo pavadinimas</label>
                                                            <input name="title" id="title{{ $note->id }}"
                                                                value="{{ $note->title }}"
                                                                class="form-control shadow-sm @error('title') border border-danger text-danger @enderror">
                                                            @error('title')
                                                                <div class="px-2 text-danger text-sm">
                                                                    <span>Lauką privaloma užpildyti</span>
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div>
                                                            <label for="body">Užrašas</label>
                                                            <textarea type="text" name="body" id="body{{ $note->id }}"
                                                                class="form-control shadow-sm textareacustom text-break @error('body') border border-danger text-danger @enderror">{{ $note->body }}</textarea>
                                                            @error('body')
                                                                <div class="px-2 text-danger text-sm">
                                                                    <span>Lauką privaloma užpildyti</span>
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Redaguoti</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Uždaryti</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endforeach

                                <div>
                                    <a class="link-info" href="{{ route('notes') }}"> Daugiau užrašų...</a>
                                </div>
                            @else
                                <div>
                                    <a class="link-info" href="{{ route('notes') }}"> Susikurkite užrašų...</a>
                                </div>
                            @endif

                        @endauth
                    </div>
                </div>
            </div>




        @endauth

        @guest
            <div class="container py-4">
                <div class="p-5 mb-4 bg-custom-trans rounded-3">
                    <div class="container-fluid py-5">
                        <h1 class="display-5 fw-bold">Sveiki atvykę!</h1>
                        <p class="col-md-8 fs-4 text-justify">Jūs įsijungėte Kovinio rengimo ir sporto zonų rezervacijos
                            sistemą, trumpiau -
                            <span class="fw-bold">KRiSZ</span>. Ši sistema skirta palengvinti zonų rezervacijas, kad jų
                            išnaudojimas būtų kuo efektyvesnis!
                        </p>
                        <p class="col-md-8 fs-5">Norint pradėti naudotis KRiSZ prisijunkite su jau turima paskyra.</p>
                        <p class="col-md-8 fs-6 text-muted">Neturint paskyros susisiekite su sistemos administratoriumi.</p>

                    </div>
                </div>

                <div class="row align-items-md-stretch">
                    <div class="col-md-6">
                        <div class="h-100 p-5 text-white bg-custom-trans rounded-3">
                            <h2>Naujienos</h2>
                            <p class="text-justify"> KRiSZ sistema yra tobulinama kiekvieną dieną. Apie visas pastabas,
                                pastebėjimus ar patobulinimus
                                praneškite sistemos adminsitratoriui.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="h-100 p-5 bg-custom-trans rounded-3">
                            <h2>Naujausia rezervacija</h2>
                            @if ($reservation)
                                <p>
                                <div class="card my-4 shadow">
                                    <p class="card-header">
                                        Rezervacija atlikta <span
                                            class="text-sm">{{ $reservation->created_at->diffForHumans() }}</span>
                                    </p>
                                    <div class="card-body text-dark">
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
                                                    <p class="card-text text-dark">
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
    <script>
        var dateToday = new Date();

        $(document).ready(function() {
            $('input.timepicker').timepicker({
                timeFormat: 'HH:mm:ss',
                interval: 15,
                minTime: '8',
                maxTime: '17',
                startTime: '8',
                dynamic: false,
                dropdown: true,
                scrollbar: true,

            });
            $("input.datepicker").datepicker({
                monthNames: ["Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa",
                    "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis"
                ],
                dayNamesShort: ["Sk", "Pr", "An", "Tr", "Kt", "Pn", "Št"],
                dayNamesMin: ["Sk", "Pr", "An", "Tr", "Kt", "Pn", "Št"],
                dateFormat: 'yy-mm-dd',
                minDate: dateToday
            });

            $('input.timepicker').keypress(function(e) {
                e.preventDefault();
            });

            $('input.datepicker').keypress(function(e) {
                e.preventDefault();
            });




        });
    </script>
@endsection
