<div class="sidebar" data-color="orange" data-background-color="white"
     data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="{{route('home')}}" class="simple-text logo-normal">
            {{ __('Início') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            @if(auth()->user()->tipo == 'Admin')
                <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
                        <i class="material-icons">settings</i>
                        <p>{{ __('Configurações') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{$activePage == 'user-management' ? 'show' : ''}}" id="laravelExample">
                        <ul class="nav">
                            <li class="nav-item{{ isset($subActivePage)  ? ($subActivePage == 'Formulários' ? ' active' : '') : '' }}">
                                <a class="nav-link" href="{{route('formulario.index')}}">
                                    <span class="sidebar-mini"> FOR </span>
                                    <span class="sidebar-normal"> {{ __('FORMULÁRIOS') }} </span>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav">
                            <li class="nav-item{{ isset($subActivePage) ? ($subActivePage  == 'Grupos' ? ' active' : '') : '' }}">
                                <a class="nav-link" href="{{route('grupo.index')}}">
                                    <span class="sidebar-mini"> GRU </span>
                                    <span class="sidebar-normal"> {{ __('GRUPOS') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item{{ $activePage == 'avaliacao' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('escolher.index') }}">
                        <i class="material-icons">library_books</i>
                        <p>{{ __('Avaliação') }}</p>
                    </a>
                </li>
            @endif
{{--            @if (auth()->user()->tipo == 'Admin' || auth()->user()->tipo == 'Avaliador' || auth()->user()->tipo == 'Supervisor')--}}
{{--                <li class="nav-item{{ $activePage == 'avaliacao' ? ' active' : '' }}">--}}
{{--                    <a class="nav-link" href="{{ route('visualizacao.escolher.edital') }}">--}}
{{--                        <i class="material-icons">library_books</i>--}}
{{--                        <p>{{ __('Avaliação') }}</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endif--}}

        </ul>
    </div>
</div>
