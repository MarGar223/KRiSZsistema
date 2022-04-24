@extends('index')

@section('content')
    <div class="cotnainer-fluid gird">
        <p class="fs-3 fw-bold text-center mt-3">
            Visi vartotojai
        </p>
        <div class="d-flex flex-column justify-content-center p-4 mt-3 bg-success">
            <form action="{{ route('allUsers') }}" method="GET" class="d-flex flex-column w-25">
                <button type="submit" class="btn btn-sm btn-warning w-25" data-bs-toggle="tooltip" data-bs-placement="top" title="Valyti filtrą">
                    <i data-feather="trash-2"></i>
                  </button>
                </form>
            <table class="table table-striped table-info table-hover p-4 mt-3 table-bordered border-light" id="myTable">
                <thead>
                    <tr class="text-center align-middle">
                        <th>
                            <div class="btn-group m-0 p-0">
                                <button class="btn btn-sm fw-bold text-black">
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
                                        <button class="btn btn-sm dropdown-item" id="all">Visi vartotojai</button>
                                    </form>
                                    @foreach ($users->sortByDesc('name')->unique('name') as $user)
                                        <form action="{{ route('filterUsers') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item text-wrap text-break" name="userNames"
                                                value="{{ $user->name }}">{{ $user->name }}
                                                {{ $user->surname }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="btn-group">
                                <button class="btn btn-sm fw-bold text-black">
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
                                        <button class="btn btn-sm dropdown-item" id="all">Visos pareigos</button>
                                    </form>
                                    @foreach ($users->unique('role') as $user)
                                        <form action="{{ route('filterUsers') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item text-wrap text-break" name="userRole"
                                                value="{{ $user->id }}">{{ $user->role }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <th scope="col">

                            <div class="btn-group">
                                <button class="btn btn-sm fw-bold text-black">
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
                                        <button class="dropdown-item btn btn-sm " id="all">Visi el. paštai</button>
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
                                <button class="btn btn-sm fw-bold text-black">
                                    Vartotojo lygis
                                </button>
                                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" id="userLevelDropdown">
                                    <form action="{{ route('allUsers') }}" method="GET">
                                        <button class="btn btn-sm dropdown-item" id="all">Visi lygiai</button>
                                    </form>
                                    @foreach ($userLevels as $userLevel)
                                        <form action="{{ route('filterUsers') }}" method="GET">
                                            @csrf
                                            <button class="btn btn-sm dropdown-item" name="userLevel"
                                                value="{{ $userLevel->id }}">{{ $userLevel->name }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        @if (auth()->user())
                            @if (auth()->user()->level == 'Administratorius')
                                <th scope="col">Funkcijos</th>
                            @endif
                        @endif
                    </tr>
                </thead>
                @if ($users->count())
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-start">
                                <td>{{ $user->name }} {{ $user->surname }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->level }}</td>
                                @if (auth()->user())
                                    @if (auth()->user()->level == 'Administratorius')
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
                                                                {{ $user->surname }}</span>? Jeigu taip, spauskite
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
                                                                                class="form-control shadow-sm @error('name') border border-danger text-danger @enderror">

                                                                            @error('name')
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
                                                                                class="form-control shadow-sm @error('surname') border border-danger text-danger @enderror">

                                                                            @error('surname')
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
                                                                                class="form-control shadow-sm @error('role') border border-danger text-danger @enderror">

                                                                            @error('role')
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
                                                                                placeholder="Įveskite vartotojo el. pašto adresą"
                                                                                value="{{ $user->email }}"
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
                                                                            <label for="password"
                                                                                class="form-label">Slaptažodis<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="password" name="password"
                                                                                id="password{{ $user->id }}"
                                                                                placeholder="Įveskite vartotojo slaptažodį"
                                                                                class="form-control shadow-sm @error('password') border border-danger text-danger @enderror">

                                                                            @error('password')
                                                                                <div class="fs-6 text-danger">
                                                                                    <span>Lauką privaloma užpildyti</span>
                                                                                </div>
                                                                            @enderror
                                                                        </div>

                                                                        <div>
                                                                            <label for="password_confirmation"
                                                                                class="form-label">Pakartoti
                                                                                slaptažodį<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="password"
                                                                                name="password_confirmation"
                                                                                id="password_confirmation{{ $user->id }}"
                                                                                placeholder="Pakartokite vartotojo slaptažodį"
                                                                                class="form-control shadow-sm @error('password_confirmation') border border-danger text-danger @enderror">

                                                                            @error('password_confirmation')
                                                                                <div class="fs-6 text-danger">
                                                                                    <span>Lauką privaloma užpildyti</span>
                                                                                </div>
                                                                            @enderror
                                                                        </div>

                                                                        <div>
                                                                            <label for="level"
                                                                                class="form-label">Vartotojo lygis<span
                                                                                    class="text-danger">*</span></label><br>
                                                                            <select name="level"
                                                                                class="form-select shadow-sm @error('level') border border-danger text-danger @enderror">
                                                                                <option value='{{ $user->level }}'>
                                                                                    {{ $user->level }}</option>
                                                                                @foreach ($userLevels as $userLevel)
                                                                                    <option
                                                                                        value='{{ $userLevel->name }}'>
                                                                                        {{ $userLevel->name }}</option>
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
                                                            <div class="modal-footer">
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
                    </tbody>




            </table>
            <div class="row">
                {{ $users->links('vendor.pagination.bootstrap-5', ['uri' => $uri]) }}
            </div>
        @else
            <p class="fs-3 fw-bold text-center mt-3">
                Vartotojų nėra
            </p>
            @endif
        </div>
        <script>
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
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
                })
        </script>
    @endsection
