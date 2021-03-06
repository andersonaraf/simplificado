@extends('layouts.header-footer')
@push('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style>
        button {
            border: none;
            width: 100%;
        }
    </style>
@endpush
@section('content')
    {{--    @extends('layouts.modal-cache')--}}
    <section class="container-fluid">
        <div class="row justify-content-center">
            <div id="carouselExampleIndicators" class="carousel slide w-100 text-center" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                @if(session('status'))
                    <span class="alert alert-success">{{session('status')}}</span>
                    {{session()->forget('status')}}
                @endif
                <div class="carousel-inner">
                    @foreach($carrossels as $carrossel)
                        <div class="carousel-item active">
                            <a href="{{is_null($carrossel->url_link) ? '#' : $carrossel->url_link}}" target="_blank">
                                <img class="container" src="{{asset('storage/'.$carrossel->url_img)}}" alt="First slide"
                                     style="width: 100%;">
                            </a>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>


        </div>
    </section>

    <main id="main">
        <!-- ======= Featured Section ======= -->
        <section id="featured" class="featured">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2>Formul??rios Liberados</h2>
                            @include('usuario.formulario.box')
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Featured Section -->

        <!-- ======= Services Section ======= -->
        @if(count($recursos) > 0)
            <section id="services" class="services ">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="section-title text-center">
                                <h2>Recursos Liberados</h2>
                                @include('usuario.recurso.box')
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- End Services Section -->
        @endif
    </main>
@endsection

@push('script')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
@endpush
