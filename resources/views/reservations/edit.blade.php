@extends('index')

@section('content')
    <div class="flex justify-center">
        <div class="item-center bg-gray-200 mt-6 p-4 w-6/12 rounded-xl">
            <div class="text-center p-4 font-medium text-xl w-full">
                <div>Naujos rezervacijos kūrimas</div>
            </div>

            <form action="{{ route('editReservation', $reservation) }}" method="POST">

                @csrf
                <div>

                    <label for="zone">Zona</label>
                    <select name="zone" id="zone" value="{{ $reservation->name }}"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('zone') border-red-500 text-red text-sm @enderror">
                        <option value="{{ $reservation->zone_id }}" id="zone_id" selected>{{ $reservation->zone->name }}
                        </option>
                        @foreach ($zones as $zone)
                            @if ($reservation->zone_id == $zone->id)
                            @else
                                <option value="{{ $zone->id }}" id="zone_id">{{ $zone->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('zone')
                        <div class="px-2 text-red-500 text-sm">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="">data</label>
                    <input type="date" name="date_when" id="date_when" value="{{ $reservation->date_when }}"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('date_when') border-red-500 text-red text-sm @enderror">
                    @error('date_when')
                        <div class="px-2 text-red-500 text-sm">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>

                <div>
                    <label for="">laikas nuo</label>
                    <input type="time" name="start_time" id="start_time" value="{{ $reservation->start_time }}"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('start_time') border-red-500 text-red text-sm @enderror">
                    @error('zone')
                        <div class="px-2 text-red-500 text-sm">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>

                <div>
                    <label for="">laikas iki</label>
                    <input type="time" name="end_time" id="end_time" value="{{ $reservation->start_time }}"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('end_time') border-red-500 text-red text-sm @enderror">
                    @error('end_time')
                        <div class="px-2 text-red-500 text-sm">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>

                <div>

                    <label for="">Skaicius asmenu</label>
                    <input type="number" name="people_count" id="people_count"
                        value="{{ $reservation->people_count }}"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('people_count') border-red-500 text-red text-sm @enderror">
                    @error('people_count')
                        <div class="px-2 text-red-500 text-sm">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>


                <button type="submit"
                    class="mt-3 px-3 py-2 bg-blue-500 text-white border shadow-sm hover:bg-blue-400 hover:scale-102 w-full rounded-md ">Redaguoti</button>

            </form>
        </div>

    </div>
@endsection
