<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('style.css?v='.rand(1,100), []) }}">
    <script src="https://kit.fontawesome.com/869011157f.js" crossorigin="anonymous"></script>

    <title>@yield('title')</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  </head>
  <body style="background-color: rgb(212, 209, 209)">
   
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-block">
            
            <div class="container">
            <a class="navbar-brand" href="#" style="font-size: 30px">YOGI JAYA RENTAL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    @if (Session::get('login')==true)
                    <a class="nav-link @yield('homeActive')" aria-current="page" href="{{ url('/', []) }}">Home</a>
                    <a class="nav-link @yield('adminActive')" aria-current="page" href="{{ url('/admin', []) }}">Admin</a>
                    <a class="nav-link @yield('dataMobilActive')" href="{{ url('/data_mobil', []) }}">Data Mobil</a>
                    @endif

                    <a class="nav-link @yield('rentalActive')" href="{{ url('/rental', []) }}">Rental Mobil</a>
                @if (Session::get('login')==true)
                <a class="nav-link @yield('pengembalianActive')" href="{{ url('/pengembalian', []) }}">Pengembalian</a>
                <a class="nav-link @yield('laporanActive')" href="{{ url('/laporan', []) }}">Laporan</a>
                @endif

                
                @if (Session::get('login')==true)
                    <a class="nav-link @yield('logoutActive') text-danger" href="{{ url('/logout', []) }}">Logout </a>
                @else
                    <a class="nav-link @yield('loginActive') text-primary" href="{{ url('/login', []) }}">Login </a>
                @endif
                

                </div>
            </div>
            
            </div>
        </nav>

        <div class="container" >
            <div class="row">
                <div class="col my-3">
                    @yield('content')
                </div>
            </div>
        </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    @include('sweetalert::alert')
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
    @yield('jquery')
  </body>
</html>