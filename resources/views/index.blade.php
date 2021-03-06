<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sidebars/">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


    <title>KRiSZ rezervacijos sistema</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-gradient bg-custom-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/" class="wrap">KRiSZ rezervacijos sistema</a>
            <ul class="navbar-nav justify-content-end me-3">
                @auth
                    <li class="nav-item">
                        <button type="submit" class="btn btn-transparent fs-6  text-white">{{ auth()->user()->name }}
                            {{ auth()->user()->surname }} {{ auth()->user()->role }}</button>
                    </li>
                    <form action="{{ route('logout') }}" method="POST">
                        <li class="nav-item">
                            @csrf
                            <button type="submit" class="btn btn-transparent fs-6  text-white">Atsijungti</button>
                        </li>
                    </form>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link active  text-white" aria-current="page" href="{{ route('auth.login') }}">Prisijungti</a>
                    </li>
                @endguest

            </ul>

        </div>
    </nav>

    <div class="container-fluid ms-0 h-100">
        <div class="row h-100 ">
            <div class="d-flex flex-column p-3 col-2 text-white  bg-custom-dark">
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link text-white"><i data-feather="home"></i> Pagrindinis</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reservation') }}" class="nav-link text-white"><i data-feather="book-open"></i> Rezervacijos</a>
                    </li>

                    @auth

                        <li class="nav-item">
                            <a href="{{ route('notes') }}" class="nav-link text-white"><i data-feather="file-text"></i> U??ra??ai</a>
                        </li>

                        @if (auth()->user()->user_level_id === 1)
                            <li class="nav-item">
                                <a href="{{ route('allUsers') }}" class="nav-link text-white"><i data-feather="user"></i> Visi vartotojai</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                <hr>
            </div>
            <div class="col-10 mil-background">
                @yield('content')
            </div>
        </div>

        <script>
            feather.replace()
        </script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
</body>

</html>
