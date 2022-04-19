@extends('index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 bg-primary">
                @if ($uri === '/test/show')
                    @foreach ($reservation as $reservation)
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
                    @endforeach
                @endif
            </div>
            <div class="col-8 me-4 bg-primary">
                <form action="{{ route('calshow') }}" method="GET">
                    <button type="">show</button>

                </form>
                <button onclick="Back()">back</button>

            </div>
        </div>
        <div>

            <script>
                function Back() {
                   if(window.location.pathname == '/test/show'){
                       window.location.replace('/test')
                   } else {
                    window.location.replace('/test/show')
                   }
                }
            </script>
        @endsection
