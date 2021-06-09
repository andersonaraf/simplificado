@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('DashBoard')])
@extends('layouts.modal-message')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">content_copy</i>
                            </div>
                            <p class="card-category">Total de Inscrições</p>
                            <h3 class="card-title">{{$inscricao_total}}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">content_copy</i>
                            </div>
                            <p class="card-category">Total de Avaliações</p>
                            <h3 class="card-title">{{$avaliacao_total}}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">content_copy</i>
                            </div>
                            <p class="card-category">Total de Recursos</p>
                            <h3 class="card-title">{{$recurso_total}}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
@endsection
@section('script')
    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script>
        const incricao = new Chartisan({
            el: '#inscricao',
            url: "@chart('chart_inscricao')",
            hooks: new ChartisanHooks()
                .datasets('doughnut')
                .pieColors(),
        });

        const avaliacao = new Chartisan({
            el: '#avaliacao',
            url: "@chart('chart_avaliacao')",
            hooks: new ChartisanHooks()
                .datasets('doughnut')
                .pieColors(),
        });

    </script>
@endsection
