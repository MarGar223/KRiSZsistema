@extends('index')

@section('content')
   <div class="grid gird-rows-2 h-fit">
       <div class="bg-red-200 m-4 p-4 h-fit">
            @foreach ($reservations as $reservation)
                <div>
                    <p class="text-lg">
                        {{ $reservation->user->name }} atliko rezervaciją <span class="text-sm">{{ $reservation->created_at->diffForHumans() }}</span>
                    </p>

                   <div>
                       Rezervuota zona: {{ $reservation->name }} <br>
                       Rezervuotas laikas nuo {{ $reservation->start_time }} iki {{ $reservation->end_time }}
                       Rezervuota {{ $reservation->people_count }} @if ($reservation->people_count === 1)
                           asmeniui
                       @else
                           asmenims
                       @endif
                   </div>

                </div>

            @endforeach
       </div>
       <div>
            rezervacija
            <div>

                <form action="{{ route('reservation') }}" method="POST" >
                    @csrf




                    <label for="zone">Zona</label>
                    <select name="zone" id="zone">
                        @foreach ($zones as $zone)
                            <option value="{{ $zone->id }}" id="zone_id">{{$zone->name}}</option>
                        @endforeach
                    </select>
                    <div>
                        <label for="">data</label>
                        <input type="date" name="date_when" id="date_when">
                    </div>

                    <div>
                        <label for="">laikas nuo</label>
                        <input type="time" name="start_time" id="start_time">
                        @error('start_time')
                            {{ $message }}
                        @enderror
                    </div>

                    <div>
                        <label for="">laikas iki</label>
                        <input type="time" name="end_time" id="end_time">
                    </div>

                    <div>
                        <label for="">Skaicius asmenu</label>
                        <input type="number" name="people_count" id="people_count">
                    </div>


                    <button type="submit">pateikti</button>
                </form>

            </div>
       </div>

   </div>
@endsection
