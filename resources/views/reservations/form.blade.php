@extends('index')

@section('content')
<div class="container-fluid">
    <p class="fs-2 text-center mt-3">
        Naujos rezervacijos kūrimas
    </p>

    <div class="container-fluid w-50">

            <form action="{{ route('createReservation') }}" method="POST" class="bg-light p-4 rounded-3 shadow">
                @csrf
                <div>
                    <div class="mb-3">
                        <label for="zone" class="form-label">Zona</label>
                        <select name="zone" id="zone"
                            class="form-select shadow-sm @error('zone') border border-danger text-danger @enderror">
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

                    <div class="mb-3">
                        <label for="date" class="form-label">Data</label>
                        <input type="date" name="date_when" id="date_when" value="{{ old('date_when') }}"
                        class="form-control shadow-sm @error('date_when') border border-danger text-danger @enderror">
                        @error('date_when')
                            <div class="fs-6 text-danger">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror
                    </div>

                <div class="mb-3">
                    <label for="start_time" class="form-label">Laikas nuo</label>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}"
                    class="form-control shadow-sm @error('start_time') border border-danger text-danger @enderror">
                    @error('start_time')
                        <div class="fs-6 text-danger">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="end_time" class="form-label">laikas iki</label>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}"
                    class="form-control shadow-sm @error('end_time') border border-danger text-danger @enderror">
                    @error('end_time')
                        <div class="fs-6 text-danger">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-3">

                    <label for="people_count" class="form-label">Skaicius asmenu</label>
                    <input type="number" name="people_count" id="people_count" value="{{ old('people_count') }}"
                    class="form-control shadow-sm @error('end_time') border border-danger text-danger @enderror">
                    @error('people_count')
                        <div class="fs-6 text-danger">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>


                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary w-50">Rezervuoti</button>
                </div>

            </form>
        </div>

    </div>
@endsection
