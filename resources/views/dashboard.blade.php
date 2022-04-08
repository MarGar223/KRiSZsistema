@extends('index')

@section('content')
    <div class="grid grid-cols-2">
        <div class="w-full bg-yellow-600">
            <p class="text-center text-xl font-medium">Mano rezervacijos</p>

            @auth


                @foreach ($user->reservations as $reservation)
                    <div class="p-4">
                        <p class="text-m my-2 px-4">
                            Rezervacija atlikta <span
                                class="text-sm">{{ $reservation->created_at->diffForHumans() }}</span>
                        </p>

                        <div class="bg-gray-200 px-4 rounded-lg w-96 shadow-lg ring-1 ring-blue-400 ring-offset-2">
                            Rezervuota zona: {{ $reservation->zone->name }} <br>
                            Rezervuota data: {{ $reservation->date_when }} <br>
                            Rezervuotas laikas nuo {{ $reservation->start_time }} iki {{ $reservation->end_time }}
                            Rezervuota {{ $reservation->people_count }} @if ($reservation->people_count === 1)
                                asmeniui
                            @else
                                asmenims
                            @endif
                            @if (auth()->user()->id == $reservation->user_id)
                                <form action="{{ route('showReservation', $reservation) }}" action="GET">
                                    @csrf
                                    <button type="submit">Redaguoti</button>
                                </form>
                                <form action="{{ route('deleteReservation', $reservation) }}" action="GET">
                                    @csrf
                                    <button type="submit">Trinti</button>
                                </form>
                            @endif
                        </div>

                    </div>

                @endforeach
            @endauth


        </div>
        <div>
            <p class="text-center text-xl font-medium">Mano užrašai</p>
            @auth


                @foreach ($user->notes as $note)
                    <div class="p-4">
                        <p class="text-m my-2 px-4">
                            Užrašas sukurtas <span class="text-sm">{{ $note->created_at->diffForHumans() }}</span>
                        </p>

                        <div class="bg-gray-200 px-4 rounded-lg w-96 shadow-lg ring-1 ring-blue-400 ring-offset-2">
                            {{ $note->body }}
                        </div>

                    </div>
                @endforeach
        @endauth
    </div>


    </div>
@endsection
