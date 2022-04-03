@extends('index')

@section('content')
    <div class="flex justify-center">
        <div class="item-center bg-gray-200 mt-6 p-4 w-6/12 rounded-xl">
            <div class="text-center p-4 font-medium text-xl w-full">
                <div>Naujo vartotojo kūrimas</div>
            </div>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-6">


                <div>
                    <label for="name" class="p-2 after:content-['*'] after:ml-0.5 after:text-red-500">Vardas</label>
                    <input type="text" name="name" id="name" placeholder="Įveskite vartotojo vardą" value="{{ old('name') }}" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('name') border-red-500 text-red text-sm  @enderror">

                        @error('name')
                            <div class="px-2 text-red-500 text-sm">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror

                </div>

                <div>
                    <label for="surname" class="p-2 after:content-['*'] after:ml-0.5 after:text-red-500">Pavardė</label>
                    <input type="text" name="surname" id="surname" placeholder="Įveskite vartotojo pavardę" value="{{ old('surname') }}" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('surname') border-red-500 text-red text-sm  @enderror">

                        @error('surname')
                            <div class="px-2 text-red-500 text-sm">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror

                </div>

                <div>
                    <label for="role" class="p-2 after:content-['*'] after:ml-0.5 after:text-red-500">Pareigos</label>
                    <input type="text" name="role" id="role" placeholder="Įveskite vartotojo pareigas" value="{{ old('role') }}" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('role') border-red-500 text-red text-sm  @enderror">

                        @error('role')
                            <div class="px-2 text-red-500 text-sm">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror
                </div>

                <div>
                    <label for="email" class="p-2 after:content-['*'] after:ml-0.5 after:text-red-500">El. paštas</label>
                    <input type="email" name="email" id="email" placeholder="Įveskite vartotojo el. pašto adresą" value="{{ old('email') }}" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('email') border-red-500 text-red text-sm  @enderror">

                        @error('email')
                            <div class="px-2 text-red-500 text-sm">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror
                </div>

                <div>
                    <label for="password" class="p-2 after:content-['*'] after:ml-0.5 after:text-red-500">Slaptažodis</label>
                    <input type="password" name="password" id="password" placeholder="Įveskite vartotojo slaptažodį" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('password') border-red-500 text-red text-sm  @enderror">

                        @error('password')
                            <div class="px-2 text-red-500 text-sm">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="p-2 after:content-['*'] after:ml-0.5 after:text-red-500">Pakartoti slaptažodį</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Pakartokite vartotojo slaptažodį" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('password_confirmation') border-red-500 text-red text-sm  @enderror">

                        @error('password_confirmation')
                            <div class="px-2 text-red-500 text-sm">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror
                </div>

                <div>
                    <label for="level" class="p-2 after:content-['*'] after:ml-0.5 after:text-red-500">Vartotojo lygis</label><br>
                        <select name="level"  class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('level') border-red-500 text-red text-sm  @enderror">
                            <option value=”” disabled selected>Priskirkite vartotojo lygį</option>
                            <option value='Admin'>Administratorius</option>
                            <option value='Instructor'>Instruktorius</option>
                            <option value='Employee'>Personalas</option>
                        </select>

                        @error('level')
                            <div class="px-2 text-red-500 text-sm">
                                <span>Privaloma pasirinkti lygį</span>
                            </div>
                        @enderror
                </div>
                </div>

                <button type="submit" value="Registruoti" class="mt-3 px-3 py-2 bg-blue-500 text-white border shadow-sm hover:bg-blue-400 w-full rounded-md">Registruoti</button>
            </form>

        </div>

    </div>
@endsection
