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
                            <td>{{ $note->created_at->diffForHumans() }}</td>
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
                                            <ul class="dropdown-menu bg-light py-1"
                                                aria-labelledby="dropdownMenuLink">
                                                <li class="text-center">
                                                    <form action="{{ route('showNote', $note) }}" action="GET">
                                                        @csrf
                                                        <button type="submit" class="btn-sm btn-success align-middle border-0 w-75" title="Redaguoti"><i data-feather="edit"></i> Redaguoti </button>
                                                    </form>
                                                </li>
                                                <li class="text-center">
                                                    <form action="{{ route('deleteNote', $note) }}" action="GET">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn-sm btn-danger align-middle border-0 w-75 mt-1" title="Trinti"><i data-feather="trash-2"></i> Trinti </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                @endif
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Rezervacijų nėra<p>
        @endif
    </div>
@endsection
