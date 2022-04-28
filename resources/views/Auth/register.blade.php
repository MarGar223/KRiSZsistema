@extends('index')

@section('content')
@auth
@if (auth()->user()->user_level_id === 1)


    <div class="container-fluid">
        <p class="fs-3 fw-bold mt-3 text-center">Naujo vartotojo kūrimas</p>

        <div class="container-fluid w-50 bg-light p-4 rounded-3 shadow">

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="grid">
                    <div class="row">
                        <div class="col">
                            <div>
                                <label for="name" class="form-label">Vardas<span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" placeholder="Įveskite vartotojo vardą" pattern="^[a-zA-Z ]*$"
                                    value="{{ old('name') }}"
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
                                <input type="text" name="surname" id="surname" placeholder="Įveskite vartotojo pavardę" pattern="^[a-zA-Z ]*$"
                                    value="{{ old('surname') }}"
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
                                    value="{{ old('role') }}"
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
                                    placeholder="Įveskite vartotojo el. pašto adresą" value="{{ old('email') }}"
                                    class="form-control shadow-sm @error('email') border border-danger text-danger @enderror">

                                @error('email')
                                    <div class="fs-6 text-danger">
                                        <span>Laukas paliktas tuščias arba šis el. pašto adresas jau užregistruotas</span>
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
                                    class="form-control shadow-sm @error('password') border border-danger text-danger @enderror" data-bs-toggle="popover" data-bs-placement="right"
                                    title = "Slaptažodžio reikalavimai"
                                    data-bs-content="Slaptažodį turi sudaryti min. 8 simboliai, iš kurių privalo būti:
                                    - Bent viena dydžioji raidė,
                                    - Bent viena mažoji raidė,
                                    - Bent vienas skaičius,
                                    - Bent vienas simbolis">

                                @error('password')
                                    <div class="fs-6 text-danger">
                                        <span>Laukas paliktas tuščias arba neatitiko reikalavimų</span>
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
                                    <option value=”” disabled selected>Priskirkite vartotojo lygį</option>
                                    @foreach ($userLevels as $userLevel)
                                        <option value='{{ $userLevel->id }}'>{{ $userLevel->name }}</option>
                                    @endforeach
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
                        <button type="submit" class="btn btn-primary w-50">Registruoti</button>
                    </div>
            </form>
        </div>
    </div>


    </div>
    @endif
    @endauth
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
@endsection
