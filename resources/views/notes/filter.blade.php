@extends('index')

@section('content')
    <div class="container-fluid">
        <p class="fs-3 fw-bold text-center text-white mt-3">Visi užrašai</p>

        <div class="d-flex-column justify-content-center p-4 mt-3">
            <div class="d-flex inline-flex justify-content-start">
            <form action="{{ route('notes') }}" method="GET">
                <button type="submit" class="btn btn-outline-light" data-bs-trigger="hover"
                    data-bs-placement="bottom" title="Valyti filtrą">
                        <i data-feather="trash-2"></i>
                    </button>
            </form>
            <div class="ms-2" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
                    aria-controls="collapseExample"> <button class="btn btn-outline-light" data-bs-trigger="hover"
                        data-bs-placement="bottom" title="Sukurti rezervaciją"><i data-feather="plus"></i></button></div>
            </div>

            <div class="d-flex justify-content-center conatiner-fluid">
                <div class="collapse rounded-3 mt-3" id="collapseExample">

                    <div class="card card-body rounded-3">
                        <form action="{{ route('createNote') }}" method="POST" class="">
                            @csrf
                                <div>
                                    <label for="title" class="form-label">Užrašo pavadinimas</label>
                                    <input name="title" id="title" value="{{ old('title') }}"
                                        class="form-control shadow-sm @error('title') border border-danger text-danger @enderror">
                                    @error('title')
                                        <div class="px-2 text-red-500 text-sm">
                                            <span>Lauką privaloma užpildyti</span>
                                        </div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="body">Turinys</label>
                                    <textarea type="text" name="body" id="body" value="{{ old('body') }}"
                                        class="form-control shadow-sm textareacustom text-break @error('body') border border-danger text-danger @enderror" rows="8" cols="50"></textarea>
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
            </div>
            <table class="table table-sm table-light table-hover p-4 mt-3 fw-bold">
                <tr class="text-center table-orange align-middle">
                    <th scope="col">
                        <div class="btn-group m-0 p-0">
                            <button class="btn fw-bold text-white">
                                Užrašas sukurtas
                            </button>
                            <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" id="noteCreatedDropdown">
                                <form action="{{ route('notes') }}" method="GET">
                                    <button class="btn btn-sm dropdown-item" id="all">Visi laikai</button>
                                </form>
                                @foreach ($notes->sortByDesc('updated_at')->unique('updated_at') as $note)
                                    <form action="{{ route('filterNotes') }}" method="GET">
                                        @csrf
                                        <button class="btn btn-sm dropdown-item" name="createdWhen"
                                            value="{{ $note->updated_at }}">{{ $note->updated_at }}</button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </th>
                    <th scope="col">
                        <div class="btn-group m-0 p-0">
                            <button class="btn fw-bold text-white">
                                Pavadinimas
                            </button>
                            <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" id="noteTitleDropdown">
                                <input type="text" class="form-control ms-2 me-4 w-auto" placeholder="Paieška..."
                                    id="myInputTitle" onkeyup="filterFunctionTitle()">
                                <form action="{{ route('notes') }}" method="GET">
                                    <button class="btn btn-sm dropdown-item" id="all">Visi laikai</button>
                                </form>
                                @foreach ($notes->sortByDesc('title')->unique('title') as $note)
                                    <form action="{{ route('filterNotes') }}" method="GET">
                                        @csrf
                                        <button class="btn btn-sm dropdown-item" name="noteTitle"
                                            value="{{ $note->title }}">{{ $note->title }}</button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </th>
                    <th scope="col">
                        <div class="btn-group m-0 p-0">
                            <button class="btn fw-bold text-white">
                                Turinys
                            </button>
                            <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" id="noteBodyDropdown">
                                <input type="text" class="form-control ms-2 me-4 w-auto" placeholder="Paieška..."
                                    id="myInputBody" onkeyup="filterFunctionBody()">
                                <form action="{{ route('notes') }}" method="GET">
                                    <button class="btn btn-sm dropdown-item" id="all">Visi turiniai</button>
                                </form>
                                @foreach ($notes->sortByDesc('body')->unique('body') as $note)
                                    <form action="{{ route('filterNotes') }}" method="GET">
                                        @csrf
                                        <button class="btn btn-sm dropdown-item text-wrap text-break" name="noteBody"
                                            value="{{ $note->body }}">{{ $note->body }}</button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </th>
                    <th scope="col align-middle">Funkcijos</th>
                </tr>
            </thead>
                @if ($notes->count())
                    <tbody>
                        @foreach ($notes as $note)
                            <tr class="text-center align-middle">
                                <td>{{ $note->updated_at->diffForHumans() }}</td>
                                <td>{{ $note->title }}</td>
                                <td class="text-break w-50">{{ $note->body }}</td>
                                @if (auth()->user())
                                    @if (auth()->user()->id == $note->user_id)
                                        <td>
                                            <div class="btn-group dropend">
                                                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i data-feather="settings" class="text-dark"></i>
                                                </a>
                                                <ul class="dropdown-menu bg-light py-1" aria-labelledby="dropdownMenuLink">
                                                    <li class="text-center">
                                                        <button type="submit"
                                                            class="btn-sm btn-success align-middle border-0 w-75"
                                                            title="Redaguoti" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalRed{{ $note->id }}"><i
                                                                data-feather="edit"></i> Redaguoti </button>
                                                    </li>
                                                    <li class="text-center">
                                                        <button type="submit"
                                                            class="btn-sm btn-danger align-middle border-0 w-75 mt-1"
                                                            title="Trinti" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $note->id }}"><i
                                                                data-feather="trash-2"></i> Trinti </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    @endif
                                @endif
                                {{-- Modal trinimo --}}
                                <form action="{{ route('deleteNote', $note) }}" method="GET">
                                    @csrf
                                    <div class="modal fade" id="exampleModal{{ $note->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Užrašo
                                                        trynimas</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Ar tikrai norite ištrinti užrašą pavadinimu: <span
                                                        class="fw-bold text-decoration-underline">{{ $note->title }}</span>?
                                                    Jeigu
                                                    taip, spauskite mygtuką
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

                                <form action="{{ route('editNote', $note) }}" method="POST">
                                    @csrf
                                    <div class="modal fade" id="exampleModalRed{{ $note->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Užrašo
                                                        trinimas</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        <label for="title" class="form-label">Užrašo pavadinimas</label>
                                                        <input name="title" id="title{{ $note->id }}"
                                                            value="{{ $note->title }}"
                                                            class="form-control shadow-sm @error('title') border border-danger text-danger @enderror">
                                                        @error('title')
                                                            <div class="px-2 text-red-500 text-sm">
                                                                <span>Lauką privaloma užpildyti</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <label for="body">Užrašas</label>
                                                        <textarea type="text" name="body" id="body{{ $note->id }}"
                                                            class="form-control shadow-sm textareacustom text-break @error('body') border border-danger text-danger @enderror">{{ $note->body }}</textarea>
                                                        @error('body')
                                                            <div class="px-2 text-red-500 text-sm">
                                                                <span>Lauką privaloma užpildyti</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Redaguoti</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Uždaryti</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
        </div>

        </tr>
        @endforeach
        @else
        <tr>
            <td>
                Užrašų nėra
            </td>
        </tr>
        </tbody>
        </table>

            @endif
    </div>
    <script>
        function filterFunctionTitle() {
            var input, filter, ul, li, a, i, btn;
            input = document.getElementById("myInputTitle");
            filter = input.value.toUpperCase();
            div = document.getElementById("noteTitleDropdown");
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

        function filterFunctionBody() {
            var input, filter, ul, li, a, i, btn;
            input = document.getElementById("myInputBody");
            filter = input.value.toUpperCase();
            div = document.getElementById("noteBodyDropdown");
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
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-trigger="hover"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
    </script>
@endsection
