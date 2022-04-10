@extends('index')

@section('content')
    <div class="container-fluid">
        <p class="fs-2 text-center mt-3">
            Naujo užrašo kūrimas
        </p>

        <div class="container-fluid w-50 bg-light p-4 rounded-3 shadow">
            <form action="{{ route('editNote', $note) }}" method="POST">
                @csrf
                <div>
                <label for="title" class="form-label">Užrašo pavadinimas</label>
                <input name="title" id="title" value="{{ $note->title }}" class="form-control shadow-sm @error('title') border border-danger text-danger @enderror">
                    @error('title')
                        <div class="px-2 text-red-500 text-sm">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="body">Užrašas</label>
                    <textarea type="text" name="body" id="body" class="form-control shadow-sm textareacustom text-break @error('body') border border-danger text-danger @enderror">{{ $note->body }}</textarea>
                    @error('body')
                        <div class="px-2 text-red-500 text-sm">
                            <span>Lauką privaloma užpildyti</span>
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary w-50">Redaguoti</button>
                </div>


            </form>
        </div>

    </div>
@endsection
