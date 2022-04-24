@extends('index')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="bg-light p-4 mt-4 rounded rounded-3 shadow">
                <div class="text-center">
                    <p class="fs-3 fw-bold">Prisijungimas prie sistemos</p>
                </div>

                @if (session('status'))
                    <div class="bg-danger text-white text-center fs-6 rounded-pill p-3 mb-2" id="status">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf

                    <div>
                        <label for="email" class="form-label ps-1">El. paštas</label>
                        <input type="email" name="email" id="email" placeholder="Įveskite savo el. pašto adresą"
                            value="{{ old('email') }}" class="form-control shadow-sm @error('email') border border-danger text-danger @enderror">

                        @error('email')
                            <div class="fs-6 text-danger">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <label for="password" class="form-label ps-1">Slaptažodis</label>
                        <input type="password" name="password" id="password" placeholder="Įveskite savo slaptažodį"
                            value="{{ old('password') }}"
                            class="form-control shadow-sm @error('password') border border-danger text-danger @enderror">

                        @error('password')
                            <div class="fs-6 text-danger">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" value="Prisijungti" class="btn btn-primary"> Prisijungti</button>
                    </div>

                </form>

            </div>
        </div>


    </div>
    <script>
        $('#status').delay(5000).fadeOut('slow');
    </script>
@endsection
