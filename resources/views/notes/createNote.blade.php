@extends('index')

@section('content')
    <div class="container-fluid">
        <p class="fs-2 fw-bold text-center mt-3">
            Naujo užrašo kūrimas
        </p>

        <div class="container-fluid w-50 bg-light p-4 rounded-3 shadow">
            <form action="{{ route('createNote') }}" method="POST">
                @csrf
                <div>
                <label for="title" class="form-label">Užrašo pavadinimas</label>
                <input name="title" id="title" value="{{ old('title') }}" class="form-control shadow-sm @error('title') border border-danger text-danger @enderror">
                    @error('title')
                        <div class="px-2 text-red-500 text-sm">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="body">Turinys</label>
                    <textarea type="text" name="body" id="body" value="{{ old('body') }}" class="form-control shadow-sm textareacustom text-break @error('body') border border-danger text-danger @enderror"></textarea>
                    @error('body')
                        <div class="px-2 text-red-500 text-sm">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary w-50">Sukurti</button>
                </div>


            </form>
        </div>

    </div>
@endsection
