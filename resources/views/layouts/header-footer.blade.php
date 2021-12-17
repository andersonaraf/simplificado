<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{is_null(title()) ? 'RB SIMPLIFICADO' : title()->titulo}}</title>
    <link rel="stylesheet" href="{{asset('css/head-footer.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/icofont/icofont/icofont.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @yield('css')
</head>
<body>
<!-- ======= Header ======= -->
<header id="header">
    <nav class="navbar navbar-expand-md">
        <div class="container d-flex">
            <div class="logo mr-auto ">
                <h1 class="text-light"><a href="{{route('inicio')}}"><span>{{is_null(title()) ? 'PS SIMPLIFICADO' : title()->titulo}}</span></a></h1>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="bx bx-menu"></span>
            </button>
            <div class="collapse navbar-collapse" style="justify-content: flex-end;" id="navbarsExample04">
                <ul class="navbar-nav ">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('inicio')}}">Início</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                            Usuário
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if(!auth()->check())
                                <a class="dropdown-item" href="{{route('login')}}">Login</a>
                                <a class="dropdown-item" href="{{route('cadastro-simplificado')}}">Criar Conta</a>
                            @endif
                            @if(auth()->check())
                                @if(strtoupper(auth()->user()->tipo) == 'ADMIN')
                                    <a class="dropdown-item" href="{{route('home')}}">Área administrativa</a>
                                @else
                                    <a class="dropdown-item" href="#">Meus Cadastros</a>
                                @endif
                            @endif
                            <div class="dropdown-divider"></div>
                            @if(auth()->check())
                                <a class="dropdown-item" href="{{route('sair')}}">Sair</a>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
@yield('content')

<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-6 footer-links">
                    <h4>Links mais Usados</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Início</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a
                                href="http://www.riobranco.ac.gov.br/files/politicadeprivacidade.pdf" target="_blank">Política
                                de Privacidade</a></li>
                    </ul>
                </div>


                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Contato</h4>
                    <p>
                        <strong>Telefone:</strong> (68) 3213-2515<br>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Direito Autoral <strong><span>Prefeitura de Rio Branco</span></strong>. Todos os Direitos Reservados.
        </div>
        <div class="credits">
            Criado por <a href="http://www.riobranco.ac.gov.br/" target="_blank">Prefeitura Municipal de Rio Branco</a>
        </div>
    </div>
</footer><!-- End Footer -->
</body>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/area-restrita/functions.js')}}"></script>
@stack('script')
</html>

