@extends('index')

@section('content')
   <div class="grid gird-rows-2 h-fit">
       <div class="bg-red-200 m-4 p-4 h-fit">
           @if ($reservations->count())
            @foreach ($reservations as $reservation)
            <div>
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
            </div>

            @endforeach

           @else
                <p>
                    Nėra sukurtų rezervacijų
                </p>
           @endif


                    {{ $reservations->links() }}



       </div>
       <div>


       </div>

   </div>
@endsection
