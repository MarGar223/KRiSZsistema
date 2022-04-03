@extends('index')

@section('content')
    <div class="flex justify-center">
        <div class="item-center bg-gray-200 mt-6 p-4 w-6/12 rounded-xl">
            <div class="text-center p-4 font-medium text-xl w-full">
                <div>Prisijungimas prie sistemos</div>
            </div>

            @if (session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>

            @endif

            <form action="{{ route('auth.login') }}" method="POST">
                @csrf

                <div>
                    <label for="email" class="p-2">El. paštas</label>
                    <input type="email" name="email" id="email" placeholder="Įveskite savo el. pašto adresą" value="{{ old('email') }}" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('name') border-red-500 text-red text-sm  @enderror">

                        @error('email')
                            <div class="px-2 text-red-500 text-sm">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror
                </div>

                <div>
                    <label for="password" class="p-2">Slaptažodis</label>
                    <input type="password" name="password" id="password" placeholder="Įveskite savo slaptažodį" value="{{ old('password') }}" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('surname') border-red-500 text-red text-sm  @enderror">

                        @error('password')
                            <div class="px-2 text-red-500 text-sm">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror
                </div>

                <button type="submit" value="Prisijungti" class="mt-3 px-3 py-2 bg-blue-500 text-white border shadow-sm hover:bg-blue-400 w-full rounded-md">Prisijungti</button>
            </form>

        </div>

    </div>
@endsection
