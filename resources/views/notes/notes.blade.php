@extends('index')

@section('content')

    <div class="d-flex justify-content-center">
        @if ($notes->count())
            <table class="table table-striped table-success table-hover p-4 mt-4 w-75">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Užrašas sukurtas</th>
                        <th scope="col">Pavadinimas</th>
                        <th scope="col">Tekstas</th>
                        <th scope="col">Funkcijos</th>
                    </tr>
                </thead>

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
                                                    trinimas</h5>
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
    </tbody>
    </table>
@else
    <p>Rezervacijų nėra
    <p>
        @endif
        </div>
    @endsection
