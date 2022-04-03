@extends('index')

@section('content')
   <div class="grid gird-rows-2 h-fit">
       <div class="bg-red-200 m-4 p-4 h-fit">
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
       </div>
       <div>
            rezervacija
            <div>
                <form action="{{ route('reservation') }}" method="POST">
                    @csrf


                    <label for="">Zona</label>
                    <select name="" id="">
                        <option value='Gronkes'>Gronkes</option>
                        <option value='Kasis'>Kasis</option>
                        <option value='Sale'>Sale</option>
                        <option value='Fule'>Fule</option>
                    </select>

                    <label for="">data</label>
                    <input type="date" name="date_when" id="date_when">

                    <label for="">laikas nuo</label>
                    <input type="time" name="start_time" id="start_time">

                    <label for="">laikas iki</label>
                    <input type="time" name="end_time" id="end_time">

                    <label for="">Skaicius asmenu</label>
                    <input type="number" name="people_count" id="people_count">

                    <button type="submit">pateikti</button>
                </form>
            </div>
       </div>

   </div>
@endsection
