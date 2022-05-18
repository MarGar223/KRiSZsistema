@extends('index')

@section('content')

<div class="container">

    <form id="resForm" value="{{auth()->user()->id}}">
        <div class="alert alert-success text-black" style="display:none"></div>

        <div class="row">
            <div class="col-1"> </div>
            <div class="mb-3 col-2">

                <label for="zone" class="form-label">Zona</label>
                <select name="zone" id="zone"
                    class="form-select shadow-sm @error('zone') border border-danger @enderror">
                    <option value="{{ old('zone') }}" id="zone_id" selected>Pasirinkti zoną</option>
                    @foreach ($zones as $zone)
                        <option value="{{ $zone->id }}" id="zone_id">{{ $zone->name }}</option>
                    @endforeach
                </select>
                @error('zone')
                    <div class="fs-6 text-danger">
                        <span>Lauką privaloma užpildyti</span>
                    </div>
                @enderror
            </div>

            <div class="mb-3 col-2">
                <label for="date" class="form-label">Data</label>
                <input type="text" name="date_when" id="date_when" value="{{ old('date_when') }}"
                    class="form-control shadow-sm @error('date_when') border border-danger text-danger @enderror datepicker"
                    placeholder="Pasirinkite datą" >
                @error('date_when')
                    <div class="fs-6 text-danger">
                        <span>Lauką privaloma užpildyti</span>
                    </div>
                @enderror
            </div>

            <div class="mb-3 col-2">
                <label for="start_time" class="form-label">Laikas nuo</label>
                <input name="start_time" id="start_time" value="{{ old('start_time') }}"
                    class="form-control shadow-sm @error('start_time') border border-danger text-danger @enderror timepicker"
                    placeholder="Pasirinkite laiką">
                @error('start_time')
                    <div class="fs-6 text-danger">
                        <span>Lauką privaloma užpildyti</span>
                    </div>
                @enderror
            </div>

            <div class="mb-3 col-2">
                <label for="end_time" class="form-label">Laikas iki</label>
                <input name="end_time" id="end_time" value="{{ old('end_time') }}"
                    class="form-control shadow-sm @error('end_time') border border-danger text-danger @enderror timepicker"
                    placeholder="Pasirinkite laiką">
                @error('end_time')
                    <div class="fs-6 text-danger">
                        <span>Lauką privaloma užpildyti</span>
                    </div>
                @enderror
            </div>

            <div class="mb-3 col-2">

                <label for="people_count" class="form-label">Žmonių skaičius</label>
                <input type="number" name="people_count" id="people_count" value="{{ old('people_count') }}"
                    class="form-control shadow-sm @error('end_time') border border-danger text-danger @enderror">
                @error('people_count')
                    <div class="fs-6 text-danger">
                        <span>Lauką privaloma užpildyti</span>
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-primary" id="ajaxSubmit">Rezervuoti</button>
            </div>
        </div>
    </form>

    <table id="reservations">
        <thead>
            <thead>
                <tr class="text-center align-middle table-orange">
                    <th scope="col">
                        <div class="btn-group m-0 p-0">
                            <button class="btn fw-bold text-white">
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
                                @foreach ($data['reservations']->sortByDesc('updated_at')->unique('updated_at') as $reservation)
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
                            <button class="btn fw-bold text-white">
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
                                @foreach ($data['reservations']->unique('user_id') as $reservation)
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
                            <button class="btn fw-bold text-white">
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
                                @foreach ($data['reservations']->unique('zone_id') as $reservation)
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
                            <button class="btn fw-bold text-white">
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
                                @foreach ($data['reservations']->sortByDesc('date_when')->unique('date_when') as $reservation)
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
                            <button class="btn fw-bold text-white">
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
                                @foreach ($data['reservations']->sortByDesc('start_time')->unique('start_time') as $reservation)
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
                            <button class="btn fw-bold text-white">
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
                                @foreach ($data['reservations']->sortByDesc('end_time')->unique('end_time') as $reservation)
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
                            <button class="btn fw-bold text-white">
                                Žmonių skaičius
                            </button>
                            <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" id="resUserDropdown">
                                <form action="{{ route('reservation') }}" method="GET">
                                    <button class="btn btn-sm dropdown-item" id="all">Visi</button>
                                </form>
                                @foreach ($data['reservations']->sortByDesc('people_count')->unique('people_count') as $reservation)
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
                        <th scope="col text-white fs-6">Funkcijos</th>
                    @endif
                </tr>
        </thead>

        <tbody>
            @foreach ($data['reservations'] as $item)
                <tr class="text-white">
                    <td>{{$item->updated_at}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->zone->name}}</td>
                    <td>{{$item->date_when}}</td>
                    <td>{{$item->start_time}}</td>
                    <td>{{$item->end_time}}</td>
                    <td>{{$item->people_count}}</td>
                    <td>funkcijos</td>
                </tr>

            @endforeach
        </tbody>

    </table>




 <script>

            jQuery('#ajaxSubmit').click(function(e){

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

               jQuery.ajax({
                  url: "{{ url('/test/post') }}",
                  method: 'post',
                  data: {

                        userId: jQuery("#resForm").attr("value"),
                        zone: jQuery('#zone').val(),
                        dateWhen: jQuery('#date_when').val(),
                        startTime: jQuery('#start_time').val(),
                        endTime: jQuery('#end_time').val(),
                        peopleCount: jQuery('#people_count').val()
                  },
                  success: function(result){

                     jQuery('.alert').show();
                     jQuery('.alert').html(result.success);
                     console.log(result.res)
                    $(document).load("/test/ #reservations");

                  }});

            });


 </script>
@endsection
