<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="     sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>E-Commerce</title>

    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
          <a href="/">
          <img src="https://seeklogo.com/images/O/ohgo-logo-59B8FCE29F-seeklogo.com.png"
                    height="48" width="48"></img>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              @if(auth()->check() && Auth::user()->role === 'vendedor')
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
              </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Meus dados
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="{{route('vendedor.produtos')}}">Meus produtos</a></li>
                          <li><a class="dropdown-item" href="{{route('vendedor.cadastro')}}">Cadastrar produto</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item" href="#">Logout</button>
                            </form>
                        </li>
                      </ul>
                  </li>
              @endif
              @if(auth()->check() && Auth::user()->role === 'comprador')
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
              </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Meus dados
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="{{route('compras')}}">Minhas compras</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item" href="#">Logout</button>
                            </form>
                        </li>
                      </ul>
                  </li>
              @endif
          </ul>
          
            <div class="d-flex">
              @if(Auth::check())
              <span>Bem Vindo, {{ Auth::user()->name }}</span>
              @else
                  <a class="btn btn-dark" href="{{ route('login') }}">Login</a>
              @endif
            </div>
            
          </div>
        </div>
      </nav>
          
  </head>
  <body data-background-color="bg4" class="bg-white">
    @yield('content')
</body>
</html>