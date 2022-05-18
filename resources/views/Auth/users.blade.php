@extends('index')

@section('content')
    <div class="cotnainer-fluid">
        <p class="fs-3 fw-bold text-white text-center mt-3">
            Visi vartotojai
        </p>
        <div class="d-flex flex-column justify-content-center p-4 mt-3">
            @if ($errors->any())
            <div class="bg-danger text-white text-center fs-6 rounded-pill p-3 mb-2 align-middle">
                Registracijoje įvyko klaida
            </div>
        @endif

            @if (session()->has('success'))
            <div class="bg-success text-white text-center fs-6 rounded-pill p-3 mb-2 align-middle">
                {{ session()->get('success') }}
            </div>
            @endif

            <div class="col-1" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
                aria-controls="collapseExample">
                <button class="btn btn-outline-light" data-bs-trigger="hover" data-bs-placement="bottom"
                    title="Sukurti naują vartotoją"><i data-feather="user-plus"></i></button>
            </div>

            <div class="d-flex justify-content-center conatiner-fluid">
                <div class="collapse rounded-3 mt-3" id="collapseExample">

                    <div class="card card-body rounded-3">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="grid">
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <label for="name" class="form-label">Vardas<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" placeholder="Įveskite vartotojo vardą"
                                                pattern="^[a-zA-Z ]*$" value="{{ old('name') }}"
                                                class="form-control shadow-sm @error('name') border border-danger text-danger @enderror"  autocomplete="off">

                                            @error('name')
                                                <div class="fs-6 text-danger">
                                                    <span>Lauką privaloma užpildyti</span>
                                                </div>
                                            @enderror

                                        </div>

                                        <div>
                                            <label for="surname" class="form-label">Pavardė<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="surname" id="surname"
                                                placeholder="Įveskite vartotojo pavardę" pattern="^[a-zA-Z ]*$"
                                                value="{{ old('surname') }}"
                                                class="form-control shadow-sm @error('surname') border border-danger text-danger @enderror"  autocomplete="off">

                                            @error('surname')
                                                <div class="fs-6 text-danger">
                                                    <span>Lauką privaloma užpildyti</span>
                                                </div>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col">
                                        <div>
                                            <label for="role" class="form-label">Pareigos<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="role" id="role"
                                                placeholder="Įveskite vartotojo pareigas" value="{{ old('role') }}"
                                                class="form-control shadow-sm @error('role') border border-danger text-danger @enderror"  autocomplete="off">

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
                                                placeholder="Įveskite vartotojo el. pašto adresą"
                                                value="{{ old('email') }}"
                                                class="form-control shadow-sm @error('email') border border-danger text-danger @enderror"  autocomplete="off">

                                            @error('email')
                                                <div class="fs-6 text-danger">
                                                    <span>Laukas paliktas tuščias arba <br> šis el. pašto adresas jau
                                                        užregistruotas</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <label for="password" class="form-label">Slaptažodis<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="password" id="password"
                                                placeholder="Įveskite vartotojo slaptažodį"
                                                class="form-control shadow-sm @error('password') border border-danger text-danger @enderror"
                                                data-bs-toggle="popover" data-bs-placement="right"
                                                title="Slaptažodžio reikalavimai" data-bs-content="Slaptažodį turi sudaryti min. 8 simboliai, iš kurių privalo būti:
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
                                            <label for="password_confirmation" class="form-label">Pakartoti
                                                slaptažodį<span class="text-danger">*</span></label>
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <table class="table table-sm table-light table-hover p-4 mt-3 fw-bold" id="myTable">
                <thead>
                    <tr class="text-center align-middle table-orange">
                        <th>
                            <div class="btn-group m-0 p-0">
                                <button class="btn fw-bold text-white">
                                    Vardas, Pavardė
                                </button>
                                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" id="UserDropdown">
                                    <input type="text" class="form-control ms-2 me-4 w-auto" placeholder="Paieška..."
                                        id="myInputUsers" onkeyup="filterFunctionUsers()">
                                    <form action="{{ route('allUsers') }}" method="GET">
                                        <button class="btn btn-sm dropdown-item">Visi vartotojai</button>
                                    </form>
                                    @foreach ($users->sortByDesc('name')->unique('name') as $user)
                                        <form action="{{ route('filterUsers') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item text-wrap text-break" name="userNames"
                                                value="{{ $user->name }};{{ $user->surname }}">{{ $user->name }}
                                                {{ $user->surname }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="btn-group">
                                <button class="btn fw-bold text-white">
                                    Pareigos
                                </button>
                                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" id="userRoleDropdown">
                                    <input type="text" class="form-control ms-2 me-4 w-auto" placeholder="Paieška..."
                                        id="myInputUserRole" onkeyup="filterFunctionUserRole()">
                                    <form action="{{ route('allUsers') }}" method="GET">
                                        <button class="btn btn-sm dropdown-item">Visos pareigos</button>
                                    </form>
                                    @foreach ($users->unique('role') as $user)
                                        <form action="{{ route('filterUsers') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item text-wrap text-break" name="userRole"
                                                value="{{ $user->role }}">{{ $user->role }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <th scope="col">

                            <div class="btn-group">
                                <button class="btn fw-bold text-white">
                                    El. pašto adresas
                                </button>
                                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" id="userEmailDropdown">
                                    <input type="text" class="form-control ms-2 me-4 w-auto" placeholder="Paieška..."
                                        id="myInputUserEmail" onkeyup="filterFunctionUserEmail()">
                                    <form action="{{ route('allUsers') }}" method="GET">
                                        <button class="dropdown-item btn btn-sm ">Visi el. paštai</button>
                                    </form>
                                    @foreach ($users->unique('email') as $user)
                                        <form action="{{ route('filterUsers') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item text-wrap text-break" name="userEmail"
                                                value="{{ $user->email }}">{{ $user->email }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="btn-group">
                                <button class="btn fw-bold text-white">
                                    Vartotojo lygis
                                </button>
                                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" id="userLevelDropdown">
                                    <form action="{{ route('allUsers') }}" method="GET">
                                        <button class="btn btn-sm dropdown-item">Visi lygiai</button>
                                    </form>
                                    @foreach ($users->unique('user_level_id') as $user)
                                        <form action="{{ route('filterUsers') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item" name="userLevel"
                                                value="{{ $user->userLevel->id }}">{{ $user->userLevel->name }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        @if (auth()->user())
                            @if (auth()->user()->user_level_id == 1)
                                <th scope="col fw-6">Funkcijos</th>
                            @endif
                        @endif
                    </tr>
                </thead>
                @if ($users->count())
                    <tbody>
                        @foreach ($users->sortByDesc('name') as $user)
                            <tr class="text-start">
                                <td>{{ $user->name }} {{ $user->surname }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->userLevel->name }}</td>
                                @if (auth()->user())
                                    @if (auth()->user()->user_level_id == 1)
                                        <td class="text-center">
                                            <div class="btn-group dropend">
                                                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i data-feather="settings" class="text-dark"></i>
                                                </a>
                                                <ul class="dropdown-menu bg-light py-1" aria-labelledby="dropdownMenuLink">
                                                    <li class="text-center">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn-sm btn-success align-middle border-0 w-75"
                                                            title="Redaguoti" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalRed{{ $user->id }}"><i
                                                                data-feather="edit"></i> Redaguoti
                                                        </button>
                                                    </li>
                                                    <li class="text-center">
                                                        <button type="submit"
                                                            class="btn-sm btn-danger align-middle border-0 w-75 mt-1"
                                                            title="Trinti" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $user->id }}"><i
                                                                data-feather="trash-2"></i> Trinti </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>


                                        <!-- Modal Trinimo -->
                                        <form action="{{ route('deleteUser', $user) }}" method="GET">
                                            @csrf
                                            <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Vartotojo
                                                                trinimas</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Ar tikrai norite ištrinti vartotoją <span
                                                                class="fw-bold text-decoration-underline">{{ $user->name }}
                                                                {{ $user->surname }} {{ $user->role }}</span>?
                                                            Jeigu taip, spauskite
                                                            mygtuką
                                                            Trinti, o jei ne - Uždaryti.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Trinti</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Uždaryti</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        {{-- Modal redagavimo --}}
                                        <form action="{{ route('editUser', $user) }}" method="POST">
                                            @csrf
                                            <div class="modal fade" id="exampleModalRed{{ $user->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Vartotojo
                                                                redagavimas</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="grid">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div>
                                                                            <label for="name"
                                                                                class="form-label">Vardas<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" name="name"
                                                                                id="name{{ $user->id }}"
                                                                                placeholder="Įveskite vartotojo vardą"
                                                                                value="{{ $user->name }}"
                                                                                pattern="^^[a-zA-Z ]*$"
                                                                                class="form-control shadow-sm @error('name' . $user->id) border border-danger text-danger @enderror">

                                                                            @error('name' . $user->id)
                                                                                <div class="fs-6 text-danger">
                                                                                    <span>Lauką privaloma užpildyti</span>
                                                                                </div>
                                                                            @enderror

                                                                        </div>

                                                                        <div>
                                                                            <label for="surname"
                                                                                class="form-label">Pavardė<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" name="surname"
                                                                                id="surname{{ $user->id }}"
                                                                                placeholder="Įveskite vartotojo pavardę"
                                                                                value="{{ $user->surname }}"
                                                                                pattern="^^[a-zA-Z ]*$"
                                                                                class="form-control shadow-sm @error('surname' . $user->id) border border-danger text-danger @enderror">

                                                                            @error('surname' . $user->id)
                                                                                <div class="fs-6 text-danger">
                                                                                    <span>Lauką privaloma užpildyti</span>
                                                                                </div>
                                                                            @enderror

                                                                        </div>

                                                                        <div>
                                                                            <label for="role"
                                                                                class="form-label">Pareigos<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" name="role"
                                                                                id="role{{ $user->id }}"
                                                                                placeholder="Įveskite vartotojo pareigas"
                                                                                value="{{ $user->role }}"
                                                                                class="form-control shadow-sm @error('role' . $user->id) border border-danger text-danger @enderror">

                                                                            @error('role' . $user->id)
                                                                                <div class="fs-6 text-danger">
                                                                                    <span>Lauką privaloma užpildyti</span>
                                                                                </div>
                                                                            @enderror
                                                                        </div>

                                                                        <div>
                                                                            <label for="email" class="form-label">El.
                                                                                paštas<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="email" name="email"
                                                                                id="email{{ $user->id }}"
                                                                                placeholder="Įveskite el. pašto adresą"
                                                                                value="{{ $user->email }}"
                                                                                class="form-control shadow-sm @error('email' . $user->id) border border-danger text-danger @enderror">

                                                                            @error('email' . $user->id)
                                                                                <div class="fs-6 text-danger">
                                                                                    <span>Laukas paliktas tuščias arba šis
                                                                                        el.
                                                                                        pašto adresas jau
                                                                                        užregistruotas</span>
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col mt-1">

                                                                        <div>
                                                                            <label class="form-label"
                                                                                for="flexSwitchCheckDefault">Slaptažodžio
                                                                                keitimas</label>
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="flexSwitchCheckDefault{{ $user->id }}"
                                                                                    onclick="checkSwitch(this.id, {{ $user->id }})">
                                                                            </div>
                                                                        </div>
                                                                        <div class="checkHidden mt-2"
                                                                            id="checkBox{{ $user->id }}">
                                                                            <label for="password"
                                                                                class="form-label">Slaptažodis<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="password" name="password"
                                                                                id="password{{ $user->id }}"
                                                                                placeholder="Įveskite slaptažodį"
                                                                                class="form-control shadow-sm @error('password' . $user->id) border border-danger text-danger @enderror"
                                                                                data-bs-toggle="popover"
                                                                                data-bs-placement="right"
                                                                                title="Slaptažodžio reikalavimai"
                                                                                data-bs-content="Slaptažodį turi sudaryti min. 8 simboliai, iš kurių privalo būti:
                                                                                                                        - Bent viena dydžioji raidė,
                                                                                                                        - Bent viena mažoji raidė,
                                                                                                                        - Bent vienas skaičius,
                                                                                                                        - Bent vienas simbolis">

                                                                            @error('password' . $user->id)
                                                                                <div class="fs-6 text-danger">
                                                                                    <span>Laukas paliktas tuščias arba
                                                                                        neatitiko
                                                                                        reikalavimų</span>
                                                                                </div>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="checkHidden"
                                                                            id="checkBoxConf{{ $user->id }}">
                                                                            <label for="password_confirmation"
                                                                                class="form-label">Pakartoti
                                                                                slaptažodį<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="password"
                                                                                name="password_confirmation"
                                                                                id="password_confirmation{{ $user->id }}"
                                                                                placeholder="Pakartokite slaptažodį"
                                                                                class="form-control shadow-sm @error('password_confirmation' . $user->id) border border-danger text-danger @enderror">

                                                                            @error('password_confirmation' . $user->id)
                                                                                <div class="fs-6 text-danger">
                                                                                    <span>Lauką privaloma užpildyti</span>
                                                                                </div>
                                                                            @enderror
                                                                        </div>

                                                                        <div>
                                                                            <label for="level"
                                                                                class="form-label">Vartotojo
                                                                                lygis<span
                                                                                    class="text-danger">*</span></label><br>
                                                                            <select name="level"
                                                                                class="form-select shadow-sm @error('level') border border-danger text-danger @enderror">
                                                                                <option
                                                                                    value='{{ $user->userLevel->id }}'>
                                                                                    {{ $user->userLevel->name }}
                                                                                </option>
                                                                                @foreach ($userLevels as $userLevel)
                                                                                    @if ($user->user_level_id != $userLevel->id)
                                                                                        <option
                                                                                            value='{{ $userLevel->id }}'>
                                                                                            {{ $userLevel->name }}
                                                                                        </option>
                                                                                    @endif
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
                                                            </div>
                                                            <div class="modal-footer mt-4">
                                                                <button type="submit"
                                                                    class="btn btn-success">Redaguoti</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Uždaryti</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </form>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                        @else
         <tr>
             <td>
                 Vartotojų nėra
             </td>
         </tr>
            @endif
                    </tbody>




            </table>

        </div>
    </div>
    <script>
        //filter start
        function filterFunctionUsers() {
            var input, filter, ul, li, a, i, btn;
            input = document.getElementById("myInputUsers");
            filter = input.value.toUpperCase();
            div = document.getElementById("UserDropdown");
            btn = div.getElementsByTagName("button");

            for (i = 1; i < btn.length; i++) {
                txtValue = btn[i].textContent || btn[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    btn[i].style.display = "";
                } else {
                    btn[i].style.display = "none";
                }
            }
        }

        function filterFunctionUserRole() {
            var input, filter, ul, li, a, i, btn;
            input = document.getElementById("myInputUserRole");
            filter = input.value.toUpperCase();
            div = document.getElementById("userRoleDropdown");
            btn = div.getElementsByTagName("button");

            for (i = 1; i < btn.length; i++) {
                txtValue = btn[i].textContent || btn[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    btn[i].style.display = "";
                } else {
                    btn[i].style.display = "none";
                }
            }
        }

        function filterFunctionUserEmail() {
            var input, filter, ul, li, a, i, btn;
            input = document.getElementById("myInputUserEmail");
            filter = input.value.toUpperCase();
            div = document.getElementById("userEmailDropdown");
            btn = div.getElementsByTagName("button");

            for (i = 1; i < btn.length; i++) {
                txtValue = btn[i].textContent || btn[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    btn[i].style.display = "";
                } else {
                    btn[i].style.display = "none";
                }
            }
        }
        // filter end

        // popover start
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-trigger="hover"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

        // popover end

        // checkbox show start
        function checkSwitch(x, id) {
            var div1 = document.getElementById('checkBox' + id);
            var div2 = document.getElementById('checkBoxConf' + id);

            div1.classList.toggle('checkHidden');
            div2.classList.toggle('checkHidden');
        }
        // checkbox show end
    </script>
@endsection
