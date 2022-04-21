@extends('index')

@section('content')
    <div class="container-fluid">
        <p class="fs-3 fw-bold text-center mt-3">Visos rezervacijos</p>

        <input type="text" name="search" id='search' onkeyup="myFunction()">

        <p id="txtHint"></p>

    </div>
    {{-- <div class="d-flex justify-content-center px-4 bg-success">
    <table class="table table-striped table-success table-hover px-4 mx-3">
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
    </table>
    </div> --}}

    <div class="d-flex-column justify-content-center p-4 mt-3 bg-success">

        @if ($reservations->count())
            <table class="table table-striped table-success table-hover p-4 mt-3" id="myTable">
                <thead>
                    <tr class="text-center align-middle">
                        <th scope="col">Rezervacija atlikta</th>
                        <th scope="col">
                            <div class="btn-group">
                                <button class="btn fw-bold text-black">
                                    Rezervuotojas
                                </button>
                                <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" onclick="filterSelection('visi')">Visi</a>
                                    @foreach ($users as $user)
                                        <a class="dropdown-item"
                                            onclick="filterSelection('{{ $user->name }}')">{{ $user->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <th scope="col">

                            <div class="btn-group">
                                <button class="btn fw-bold text-black">
                                    Zona
                                </button>
                                <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" onclick="filterSelection('visi')">Visos</a>
                                    @foreach ($zones as $zone)
                                        <a class="dropdown-item"
                                            onclick="filterSelection('{{ $zone->name }}')">{{ $zone->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </th>
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
                        <tr class="text-center filterDiv {{ $reservation->zone->name }} {{ $reservation->user->name }}"
                            id="{{ $reservation->user->id }}">

                            <td>{{ $reservation->updated_at->diffForHumans() }}</td>
                            <td>{{ $reservation->user->name }}</td>
                            <td>{{ $reservation->zone->name }}</td>
                            <td>{{ $reservation->date_when }}</td>
                            <td>{{ $reservation->start_time }}</td>
                            <td>{{ $reservation->end_time }}</td>
                            <td>{{ $reservation->people_count }}</td>

                            @if (auth()->user())
                                @if (auth()->user()->level == 'Administratorius' || auth()->user()->level == 'Instruktorius')
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
                                        <td></td>
                                    @endif
                                @endif

                                {{-- Modal redagavimas --}}

                                <form action="{{ route('editReservation', $reservation) }}" method="POST">
                                    @csrf
                                    <div class="modal fade" id="exampleModalRed{{ $reservation->id }}" tabindex="-1"
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
                                                        <input type="date" name="date_when"
                                                            id="date_when{{ $reservation->id }}"
                                                            value="{{ $reservation->date_when }}"
                                                            class="form-control shadow-sm @error('date_when') border border-danger text-danger @enderror">
                                                        @error('date_when')
                                                            <div class="fs-6 text-danger">
                                                                <span>Lauką privaloma užpildyti</span>
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="start_time" class="form-label">Laikas nuo</label>
                                                        <input type="time" name="start_time"
                                                            id="start_time{{ $reservation->id }}"
                                                            value="{{ $reservation->start_time }}"
                                                            class="form-control shadow-sm @error('start_time') border border-danger text-danger @enderror">
                                                        @error('start_time')
                                                            <div class="fs-6 text-danger">
                                                                <span>Lauką privaloma užpildyti</span>
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="end_time" class="form-label">laikas iki</label>
                                                        <input type="time" name="end_time"
                                                            id="end_time{{ $reservation->id }}"
                                                            value="{{ $reservation->end_time }}"
                                                            class="form-control shadow-sm @error('end_time') border border-danger text-danger @enderror">
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
                                                        <button type="submit" class="btn btn-success">Redaguoti</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Uždaryti</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>\
                                    </div>
                                </form>
                        </tr>


                        {{-- Modal trinimo --}}
                        {{-- <form action="{{ route('deleteReservation', $reservation) }}" method="GET"> --}}
                            {{-- @csrf --}}
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
                                                <button type="submit" class="btn btn-danger" onclick="trinti({{ $reservation->id }})" data-bs-dismiss="modal">Trinti</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Uždaryti</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </form> --}}
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
        // filter dropdown
        filterSelection("visi");

        function filterSelection(c) {
            var x, i;
            x = document.getElementsByClassName("filterDiv");
            if (c == "visi") c = "";
            for (i = 0; i < x.length; i++) {
                w3RemoveClass(x[i], "show");
                if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
            }
        }

        function w3AddClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                if (arr1.indexOf(arr2[i]) == -1) {
                    element.className += " " + arr2[i];
                }
            }
        }

        function w3RemoveClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                while (arr1.indexOf(arr2[i]) > -1) {
                    arr1.splice(arr1.indexOf(arr2[i]), 1);
                }
            }
            element.className = arr1.join(" ");
        }
        // end filter dropdown

        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function trinti(id) {
            var trinamas = document.getElementById("trinamas");
            var irasas = document.getElementsByTagName("tr");
            var xhttp;

            xhttp = new XMLHttpRequest();
            if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            xhttp.open("GET", "rezervacijos/" + id + "/trinti", true);
            xhttp.send();
            xhttp.open("GET", "rezervacijos", true);
            xhttp.send();
        }
    </script>
@endsection
