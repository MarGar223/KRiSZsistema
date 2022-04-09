@extends('index')

@section('content')
   <div class="h-fit">
       <div class="bg-red-200 m-4 p-4 h-fit justify-between">
           @if ($reservations->count())
            @foreach ($reservations as $reservation)
            <div class="p-4">
                <p class="text-lg my-2 px-4">
                    {{ $reservation->user->name }} atliko rezervaciją <span class="text-sm">{{ $reservation->created_at->diffForHumans() }}</span>
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
                </div>
                @if (auth()->user())
                <form action="{{ route('showReservation', $reservation) }}" action="GET">
                    @csrf
                    <button type="submit">Redaguoti</button>
                </form>

                @if (auth()->user()->level == 'Admin' || auth()->user()->level == 'Instructor' || auth()->user()->id == $reservation->user_id)
                    <form action="{{ route('deleteReservation', $reservation) }}" action="GET">
                        @csrf
                        <button type="submit">Trinti</button>
                    </form>
                @endif
                @endif


            </div>

            @endforeach

           @else
                <p>
                    Nėra sukurtų rezervacijų
                </p>
           @endif
                    {{ $reservations->links() }}
       </div>
   </div>
@endsection
