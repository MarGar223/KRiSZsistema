@extends('index')

@section('content')
    <div class="container-fluid">
        <p class="fs-3 fw-bold mt-3 text-center">Naujo vartotojo kūrimas</p>

        <div class="container-fluid w-50 bg-light p-4 rounded-3 shadow">

            <form action="{{ route('editUser', $user) }}" method="POST">
                @csrf
                <div class="grid">
                    <div class="row">
                        <div class="col">
                            <div>
                                <label for="name" class="form-label">Vardas<span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" placeholder="Įveskite vartotojo vardą"
                                    value="{{ $user->name }}"
                                    class="form-control shadow-sm @error('name') border border-danger text-danger @enderror">

                                @error('name')
                                    <div class="fs-6 text-danger">
                                        <span>Lauką privaloma užpildyti</span>
                                    </div>
                                @enderror

                            </div>

                            <div>
                                <label for="surname" class="form-label">Pavardė<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="surname" id="surname" placeholder="Įveskite vartotojo pavardę"
                                    value="{{ $user->surname }}"
                                    class="form-control shadow-sm @error('surname') border border-danger text-danger @enderror">

                                @error('surname')
                                    <div class="fs-6 text-danger">
                                        <span>Lauką privaloma užpildyti</span>
                                    </div>
                                @enderror

                            </div>

                            <div>
                                <label for="role" class="form-label">Pareigos<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="role" id="role" placeholder="Įveskite vartotojo pareigas"
                                    value="{{ $user->role }}"
                                    class="form-control shadow-sm @error('role') border border-danger text-danger @enderror">

                                @error('role')
                                    <div class="fs-6 text-danger">
                                        <span>Lauką privaloma užpildyti</span>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="form-label">El. paštas<span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email" id="email"
                                    placeholder="Įveskite vartotojo el. pašto adresą" value="{{ $user->email }}"
                                    class="form-control shadow-sm @error('email') border border-danger text-danger @enderror">

                                @error('email')
                                    <div class="fs-6 text-danger">
                                        <span>Lauką privaloma užpildyti</span>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <label for="password" class="form-label">Slaptažodis<span
                                        class="text-danger">*</span></label>
                                <input type="password" name="password" id="password"
                                    placeholder="Įveskite vartotojo slaptažodį"
                                    class="form-control shadow-sm @error('password') border border-danger text-danger @enderror">

                                @error('password')
                                    <div class="fs-6 text-danger">
                                        <span>Lauką privaloma užpildyti</span>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="form-label">Pakartoti slaptažodį<span
                                        class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="Pakartokite vartotojo slaptažodį"
                                    class="form-control shadow-sm @error('password_confirmation') border border-danger text-danger @enderror">

                                @error('password_confirmation')
                                    <div class="fs-6 text-danger">
                                        <span>Lauką privaloma užpildyti</span>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label for="level" class="form-label">Vartotojo lygis<span
                                        class="text-danger">*</span></label><br>
                                <select name="level"
                                    class="form-select shadow-sm @error('level') border border-danger text-danger @enderror">
                                        <option value='{{ $user->level_id }}'>{{ $user->level_id->name }}</option>
                                    @foreach ($userLevels as $userLevel)
                                        <option value='{{ $userLevel->id }}'>{{ $userLevel->name }}</option>
                                    @endforeach>
                                </select>

                                @error('level')
                                    <div class="fs-6 text-danger">
                                        <span>Privaloma pasirinkti lygį</span>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary w-50">Redaguoti</button>
                    </div>
            </form>
        </div>
    </div>


    </div>
@endsection
