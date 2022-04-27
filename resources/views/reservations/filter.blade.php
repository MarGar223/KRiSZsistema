@extends('index')

@section('content')
    <div class="container-fluid">
        <p class="fs-3 fw-bold text-center mt-3">Visos rezervacijos</p>


        <div class="d-flex flex-column justify-content-center p-4 mt-3 bg-success">
            <form action="{{ route('reservation') }}" method="GET" class="d-flex flex-column w-25">
                <button type="submit" class="btn btn-sm btn-warning w-25" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Valyti filtrą">
                    <i data-feather="trash-2"></i>
                </button>
            </form>
            @if (session('status'))
                        <div class="bg-danger text-white text-center fs-6 rounded-pill p-3 mb-2 align-middle" id='status'>
                            {{ session('status') }}
                        </div>
                    @endif
            <table class="table table-striped table-info table-hover p-4 mt-3 table-bordered border-light" id="myTable">
                <thead>
                    <tr class="text-center align-middle">
                        <th scope="col">
                            <div class="btn-group m-0 p-0">
                                <button class="btn btn-sm fw-bold text-black">
                                    Rezervacija atlikta
                                </button>
                                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" id="resUserDropdown">
                                    <form action="{{ route('reservation') }}" method="GET">
                                        <button class="btn btn-sm dropdown-item" id="all">Visi laikai</button>
                                    </form>
                                    @foreach ($reservations->sortByDesc('updated_at')->unique('updated_at') as $reservation)
                                        <form action="{{ route('filterReservation') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item" name="resWhen"
                                                value="{{ $reservation->updated_at }}">{{ $reservation->updated_at }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="btn-group">
                                <button class="btn btn-sm fw-bold text-black">
                                    Rezervuotojas
                                </button>
                                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" id="resUserDropdown">
                                    <input type="text" class="form-control ms-2 me-4 w-auto" placeholder="Paieška..."
                                        id="myInputResUser" onkeyup="filterFunctionResUsers()">
                                    <form action="{{ route('reservation') }}" method="GET">
                                        <button class="btn btn-sm dropdown-item" id="all">Visi</button>
                                    </form>
                                    @foreach ($reservations->unique('user_id') as $reservation)
                                        <form action="{{ route('filterReservation') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item" name="userId"
                                                value="{{ $reservation->user_id }}">{{ $reservation->user->name }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <th scope="col">

                            <div class="btn-group">
                                <button class="btn btn-sm fw-bold text-black">
                                    Zona
                                </button>
                                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" id="resZoneDropdown">
                                    <input type="text" class="form-control ms-2 me-4 w-auto" placeholder="Paieška..."
                                        id="myInputResZone" onkeyup="filterFunctionResZone()">
                                    <form action="{{ route('reservation') }}" method="GET">
                                        <button class="dropdown-item btn btn-sm" id="all">Visos</button>
                                    </form>
                                    @foreach ($reservations->unique('zone_id') as $reservation)
                                        <form action="{{ route('filterReservation') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item" name="zoneId"
                                                value="{{ $reservation->zone_id }}">{{ $reservation->zone->name }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="btn-group">
                                <button class="btn btn-sm fw-bold text-black">
                                    Rezervuota data
                                </button>
                                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" id="resUserDropdown">
                                    <form action="{{ route('reservation') }}" method="GET">
                                        <button class="btn btn-sm dropdown-item" id="all">Visos datos</button>
                                    </form>
                                    @foreach ($reservations->sortByDesc('date_when')->unique('date_when') as $reservation)
                                        <form action="{{ route('filterReservation') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item" name="dateWhen"
                                                value="{{ $reservation->date_when }}">{{ $reservation->date_when }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="btn-group">
                                <button class="btn btn-sm fw-bold text-black">
                                    Pradžios laikas
                                </button>
                                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" id="resUserDropdown">
                                    <form action="{{ route('reservation') }}" method="GET">
                                        <button class="btn btn-sm dropdown-item" id="all">Visi laikai</button>
                                    </form>
                                    @foreach ($reservations->sortByDesc('start_time')->unique('start_time') as $reservation)
                                        <form action="{{ route('filterReservation') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item" name="startWhen"
                                                value="{{ $reservation->start_time }}">{{ $reservation->start_time }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="btn-group">
                                <button class="btn btn-sm fw-bold text-black">
                                    Pabaigos laikas
                                </button>
                                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" id="resUserDropdown">
                                    <form action="{{ route('reservation') }}" method="GET">
                                        <button class="btn btn-sm dropdown-item" id="all">Visi laikai</button>
                                    </form>
                                    @foreach ($reservations->sortByDesc('end_time')->unique('end_time') as $reservation)
                                        <form action="{{ route('filterReservation') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item" name="endWhen"
                                                value="{{ $reservation->end_time }}">{{ $reservation->end_time }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="btn-group">
                                <button class="btn btn-sm fw-bold text-black">
                                    Personalo skaičius
                                </button>
                                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" id="resUserDropdown">
                                    <form action="{{ route('reservation') }}" method="GET">
                                        <button class="btn btn-sm dropdown-item" id="all">Visi</button>
                                    </form>
                                    @foreach ($reservations->sortByDesc('people_count')->unique('people_count') as $reservation)
                                        <form action="{{ route('filterReservation') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item" name="resPeople"
                                                value="{{ $reservation->people_count }}">{{ $reservation->people_count }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        @if (auth()->user())
                            <th scope="col" style="font-size: 0.7875rem;">Funkcijos</th>
                        @endif

                    </tr>
                </thead>
                @if ($reservations->count())
                    <tbody>
                        @foreach ($reservations as $reservation)
                            {{-- <tr class="text-center filterDiv {{ $reservation->zone->name }} {{ $reservation->user->name }}"
                                id="{{ $reservation->user->id }}"> --}}
                            <tr class="text-center align-middle">

                                <td>{{ $reservation->updated_at->diffForHumans() }} <br> <span
                                        class="fs-6 text-muted">{{ $reservation->updated_at }} </span> </td>
                                <td>{{ $reservation->user->name }} {{ $reservation->user->surname }} <br> <span
                                        class="text-muted">{{ $reservation->user->role }}</span> </td>
                                <td>{{ $reservation->zone->name }}</td>
                                <td>{{ $reservation->date_when }}</td>
                                <td>{{ $reservation->start_time }}</td>
                                <td>{{ $reservation->end_time }}</td>
                                <td>{{ $reservation->people_count }}</td>

                                @if (auth()->user())
                                    @if (auth()->user()->level_id == 1 || auth()->user()->level_id == 2)
                                        <td>
                                            <div class="btn-group dropend">
                                                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i data-feather="settings" class="text-dark"></i>
                                                </a>
                                                <ul class="dropdown-menu bg-light py-1" aria-labelledby="dropdownMenuLink">
                                                    <li class="text-center">
                                                        <button type="submit"
                                                            class="btn-sm btn-success align-middle border-0 w-75"
                                                            title="Redaguoti" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalRed{{ $reservation->id }}"><i
                                                                data-feather="edit"></i> Redaguoti </button>
                                                    </li>
                                                    <li class="text-center">
                                                        <button type="submit"
                                                            class="btn-sm btn-danger align-middle border-0 w-75 mt-1"
                                                            title="Trinti" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $reservation->id }}"><i
                                                                data-feather="trash-2"></i> Trinti </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    @else
                                        @if (auth()->user()->id == $reservation->user_id)
                                            <td>
                                                <div class="btn-group dropend">
                                                    <a href="#" role="button" id="dropdownMenuLink"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i data-feather="settings" class="text-dark"></i>
                                                    </a>
                                                    <ul class="dropdown-menu bg-light py-1"
                                                        aria-labelledby="dropdownMenuLink">
                                                        <li class="text-center">
                                                            <button type="submit"
                                                                class="btn-sm btn-success align-middle border-0 w-75"
                                                                title="Redaguoti" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalRed{{ $reservation->id }}"><i
                                                                    data-feather="edit"></i> Redaguoti </button>
                                                        </li>
                                                        <li class="text-center">

                                                            <button type="submit"
                                                                class="btn-sm btn-danger align-middle border-0 w-75 mt-1"
                                                                title="Trinti" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal{{ $reservation->id }}"><i
                                                                    data-feather="trash-2"></i> Trinti </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                    @endif

                                    {{-- Modal redagavimas --}}

                                    <form action="{{ route('editReservation', $reservation) }}" method="POST">
                                        @csrf
                                        <div class="modal fade" id="exampleModalRed{{ $reservation->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
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
                                                                <option value="{{ $reservation->zone_id }}" id="zone_id"
                                                                    selected>{{ $reservation->zone->name }}
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
                                                            <input type="text" name="date_when"
                                                                id="date_when{{ $reservation->id }}"
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
                                                            <input name="start_time"
                                                                id="start_time{{ $reservation->id }}"
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
                                                            <label for="end_time" class="form-label">laikas iki</label>
                                                            <input name="end_time"
                                                                id="end_time{{ $reservation->id }}"
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

                                                            <label for="people_count" class="form-label">Skaicius
                                                                asmenu</label>
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
                                                            <button type="submit"
                                                                class="btn btn-success">Redaguoti</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Uždaryti</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            </tr>


                            {{-- Modal trinimo --}}
                            <form action="{{ route('deleteReservation', $reservation) }}" method="GET">
                                @csrf
                                <div class="modal fade" id="exampleModal{{ $reservation->id }}" tabindex="-1"
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
                                                    <button type="submit" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Trinti</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Uždaryti</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                @endforeach
                </tbody>
            </table>
        @else
            <p>Rezervacijų nėra
            <p>
                @endif
        </div>
        <script>
            function filterFunctionResUsers() {
                var input, filter, ul, li, a, i, btn;
                input = document.getElementById("myInputResUser");
                filter = input.value.toUpperCase();
                div = document.getElementById("resUserDropdown");
                btn = div.getElementsByTagName("button");

                for (i = 1; i < btn.length; i++) {
                    txtValue = btn[i].textContent || btn[i].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        btn[i].style.display = "";
                    } else {
                        btn[i].style.display = "none";
                    }
                }
            }

            function filterFunctionResZone() {
                var input, filter, ul, li, a, i, btn;
                input = document.getElementById("myInputResZone");
                filter = input.value.toUpperCase();
                div = document.getElementById("resZoneDropdown");
                btn = div.getElementsByTagName("button");

                for (i = 0; i < btn.length; i++) {
                    txtValue = btn[i].textContent || btn[i].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        btn[i].style.display = "";
                    } else {
                        btn[i].style.display = "none";
                    }
                }
            }

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            $(document).ready(function() {
                $('input.timepicker').timepicker({
                    timeFormat: 'HH:mm:ss',
                    interval: 5,
                    minTime: '8',
                    maxTime: '17',
                    startTime: '8:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true,

            });
        });

            var dateToday = new Date();
            $(document).ready(function() {
                $("input.datepicker").datepicker({
                    monthNames: ["Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa",
                        "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis"
                    ],
                    dayNamesShort: ["Sk", "Pr", "An", "Tr", "Kt", "Pn", "Št"],
                    dayNamesMin: ["Sk", "Pr", "An", "Tr", "Kt", "Pn", "Št"],
                    dateFormat: 'yy-mm-dd',
                    minDate: dateToday
                });
            });
            $('#status').delay(5000).fadeOut('slow');
        </script>
    @endsection
