@extends('index')

@section('content')
    <div class="flex justify-center">
        <div class="item-center bg-gray-200 mt-6 p-4 w-6/12 rounded-xl">
            <div class="text-center p-4 font-medium text-xl w-full">
                <div>Naujos rezervacijos kūrimas</div>
            </div>

            <form action="{{ route('createNote') }}" method="POST" >
                @csrf
                <div>
                <label for="title">Užrašo pavadinimas</label>
                <input name="title" id="title" value="{{ old('title') }}" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('title') border-red-500 text-red text-sm  @enderror">

                    @error('title')
                        <div class="px-2 text-red-500 text-sm">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="body">Užrašas</label>
                    <textarea type="text" name="body" id="body" value="{{ old('body') }}" class="indent-8 mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 w-full rounded-md @error('body') border-red-500 text-red text-sm  @enderror"></textarea>
                    @error('body')
                        <div class="px-2 text-red-500 text-sm">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>

                <button type="submit" class="mt-3 px-3 py-2 bg-blue-500 text-white border shadow-sm hover:bg-blue-400 hover:scale-102 w-full rounded-md ">Sukurti užrašą</button>

            </form>
        </div>

    </div>
@endsection
