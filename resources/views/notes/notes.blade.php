@extends('index')

@section('content')

    <div class="container-fluid">
        <p class="fs-3 text-center mt-3">
            Mano užrašai
        </p>

        <div class="d-flex justify-content-center">
            <div class="container-fluid w-50 mb-5">
                @foreach ($notes as $note)

                <div class="accordion mt-2" id="noteAccordion">
                    <div class="accordion-item">
                        <label class="fs-6 fw-light text-muted">Sukurta: {{ $note->created_at->diffForHumans() }}</label>
                      <h2 class="accordion-header" id="heading{{ $note->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $note->id }}" aria-expanded="true" aria-controls="collapse{{ $note->id }}">
                            {{ $note->title }}
                        </button>

                      </h2>
                      <div id="collapse{{ $note->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $note->id }}" data-bs-parent="#noteAccordion">
                        <div class="accordion-body">

                            <p class="text-break">
                                {{ $note->body }}
                            </p>
                            @if (auth()->user())
                                <td>
                                    <div class="d-flex">
                                        <form action="" action="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm mx-1">Redaguoti</button>
                                        </form>
                                        <form action="" action="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Trinti</button>
                                        </form>
                                    </div>
                                </td>

                        @endif

                        </div>
                      </div>
                    </div>
                  </div>

                  @endforeach
            </div>
        </div>
    </div>

@endsection
