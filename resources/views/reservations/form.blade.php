@extends('index')

@section('content')
    <div class="flex justify-center">
        <div class="item-center bg-gray-200 mt-6 p-4 w-6/12 rounded-xl">
            <div class="text-center p-4 font-medium text-xl w-full">
                <div>Naujos rezervacijos kūrimas</div>
            </div>

            <form action="{{ route('createReservation') }}" method="POST" >
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

            <form action="{{ route('reservation') }}">
                @csrf
                <button type="submit">atgal</button>
            </form>
        </div>

    </div>
@endsection
