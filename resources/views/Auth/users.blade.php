@extends('index')

@section('content')


{{$uri}}


    <div class="cotnainer-fluid gird">
        <p class="fs-3 fw-bold text-center mt-3">
            Visi vartotojai
        </p>
        <div class="d-flex justify-content-center row">
            @if ($users->count())
                <table class="table table-striped table-success table-hover p-4 mt-4 w-75">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Vardas, Pavardė</th>
                            <th scope="col">Pareigos</th>
                            <th scope="col">El. pašto adresas</th>
                            <th scope="col">Vartotojo lygis</th>
                            @if (auth()->user())
                                @if (auth()->user()->level == 'Administratorius')
                                    <th scope="col">Funkcijos</th>
                                @endif
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-center">
                                <td>{{ $user->name }} {{ $user->surname }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->level }}</td>
                                @if (auth()->user())
                                    @if (auth()->user()->level == 'Administratorius')
                                        <td>
                                            <div class="btn-group dropend">
                                                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i data-feather="settings" class="text-dark"></i>
                                                </a>
                                                <ul class="dropdown-menu bg-light py-1"
                                                    aria-labelledby="dropdownMenuLink">
                                                    <li class="text-center">
                                                        <form action="{{ route('editUser', $user) }}" action="GET">
                                                            @csrf
                                                            <button type="submit" class="btn-sm btn-success align-middle border-0 w-75" title="Redaguoti"><i data-feather="edit"></i> Redaguoti </button>
                                                        </form>
                                                    </li>
                                                    <li class="text-center">
                                                        {{-- <form action="{{ route('deleteUser', $user) }}" action="GET"> --}}
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn-sm btn-danger align-middle border-0 w-75 mt-1" title="Trinti" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}"><i data-feather="trash-2"></i> Trinti </button>
                                                        {{-- </form> --}}
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                              <!-- Button trigger modal -->

  <!-- Modal -->
  <form action="{{ route('deleteUser', $user) }}" action="GET">
  <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Vartotojo trinimas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Ar tikrai norite ištrinti vartotoją <span class="fw-bold text-decoration-underline">{{ $user->name }} {{$user->surname}}</span>? Jeigu taip, spauskite mygtuką Trinti, o jei ne - Uždaryti.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Uždarti</button>
          <button type="submit" class="btn btn-danger">Trinti</button>
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

    @endsection
