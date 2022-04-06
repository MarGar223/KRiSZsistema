<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>KRiSZ rezervacijos sistema</title>
</head>
<body>

    <div class="bg-yellow-200 w-full">
        <nav class="flex item-center justify-between">
            <ul class="p-4 bg-red-200 w-64">
                <li class="text-center">
                    <a href="" class="">Kovinio rengimo ir sporto zonų rezervacijos sistema</a>
                </li>
            </ul>
            <ul class="flex item-center p-4">
                @auth
                <li class="p-4">
                    <a href="">{{ auth()->user()->name }} {{ auth()->user()->surname }} {{ auth()->user()->role }}</a>
                </li>

                <form action="{{ route('logout') }}" method="POST">
                <li class="p-4">
                        @csrf
                        <button type="submit">Atsijungti</button>
                </li>
                </form>
                @endauth

                @guest
                <li  class="p-4">
                    <a href="{{ route('auth.login') }}">Prisijungti</a>
                </li>
                @endguest




            </ul>
        </nav>
    </div>


    <div class="grid grid-cols-12 h-fit">

        <div class="bg-red-200 col-span-2 h-full w-64">
            <div class="text-center jusitfy-between bg-white">
                <nav class="pt-4">
                    <ul class="item-center">
                        <li class="p-4">
                            <a href="{{ route('dashboard') }}">Pagrindinis</a>
                        </li>
                        <li class="p-4">
                            <a href="{{ route('reservation') }}">Rezervacijos</a>
                        </li>

                        @auth
                        <li class="p-4">
                            <a href="{{ route('createReservation') }}">Atlikti rezervaciją</a>
                        </li>

                        <li class="p-4">
                            <a href="{{ route('notes') }}">Užrašai</a>
                        </li>
                        <li class="p-4">
                            <a href="{{ route('createNote') }}">Kurti užrašą</a>
                        </li>
                        @if (auth()->user()->level === 'Admin')
                        <li class="p-4">
                            <a href="{{ route('register') }}">Registruoti</a>
                        </li>
                        @endif
                        @endauth
                        <li class="p-4">
                            <a href="">HelpDesk</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="bg-blue-200 col-span-10 h-full">

            @yield('content')

        </div>
    </div>




    <footer class="bg-gray-200 relative bottom-0 w-full h-20 text-center mt-12">
            Marius Garbenis IIST18
    </footer>
</body>
</html>
