@extends('index')

@section('content')

   <div class="h-fit">
       <div class="bg-red-200 m-4 p-4 h-fit flex flex-wrap justify-between">
           @if ($notes->count())
            @foreach ($notes as $note)
            <div class="p-4">
                <p class="text-lg my-2 px-4">
                    {{ $note->title }}
                    <span class="text-sm"> Sukurta {{ $note->created_at->diffForHumans() }}</span>
                </p>

                <div class="bg-gray-200 px-4 rounded-lg w-96 shadow-lg ring-1 ring-blue-400 ring-offset-2">
                    {{ $note->body }}
                </div>
            </div>

            @endforeach

           @else
                <p>
                    Užrašų neturite
                </p>
           @endif

   </div>
@endsection
