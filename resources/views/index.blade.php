<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sidebars/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>KRiSZ rezervacijos sistema</title>
</head>

<body style="background-color:darkkhaki">

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/" class="wrap">Kovinio rengimo ir sporto zonų rezervacijos
                sistema</a>
            <ul class="navbar-nav justify-content-end">
                @auth
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">{{ auth()->user()->name }}
                            {{ auth()->user()->surname }} {{ auth()->user()->role }}</a>
                    </li>
                    <form action="{{ route('logout') }}" method="POST">
                        <li class="nav-item">
                            @csrf
                            <button type="submit" class="">Atsijungti</button>
                        </li>
                    </form>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('auth.login') }}">Prisijungti</a>
                    </li>
                @endguest

            </ul>

        </div>
    </nav>

    <div class="container-fluid ms-0">
        <div class="row">
            <div class="d-flex flex-column flex-shrink-0 p-3 col-2">
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link text-black">Pagrindinis</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reservation') }}" class="nav-link text-black">Rezervacijos</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a href="{{ route('createReservation') }}" class="nav-link text-black">Atlikti rezervaciją</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('notes') }}" class="nav-link text-black">Užrašai</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('createNote') }}" class="nav-link text-black">Kurti užrašą</a>
                        </li>
                        @if (auth()->user()->level === 'Admin')
                            <li class="nav-item">
                                <a href="{{ route('allUsers') }}" class="nav-link text-black">Visi vartotojai</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link text-black">Registruoti</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                <hr>
            </div>
            <div class="col-10">
                @yield('content')
            </div>
        </div>

</body>

</html>
