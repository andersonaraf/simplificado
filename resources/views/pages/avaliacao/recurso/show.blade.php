@extends('layouts.app', [ 'activePage' => 'avaliacao', 'titlePage' => __('Lista de Candidatos')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <h4 class="text-dark font-weight-bold">INFORMAÇÕES DO PARTICIPANTE</h4>
                    <hr style="width: 100%;">
                    @include('pages.avaliacao.candidato.dados_pessoais')
                    <form method="post" action="#" id="formPontuar" class="w-100">
                        @csrf
                        @include('pages.avaliacao.recurso.recuso')
                        @include('pages.avaliacao.candidato.anexos', ['pontuavel' => false])
                        <div class="row justify-content-end">
                            <div class="col col-12 text-right">
                                <input type="button" data-tipo-avaliacao="APROVAR"
                                       class="btn btn-outline-success font-weight-bold avaliar" value="{{isset($recurso) ? 'ACEITA RECURSO' : 'APROVAR'}}">
                                <input type="button" data-tipo-avaliacao="REPROVAR"
                                       class="btn btn-outline-danger font-weight-bold avaliar" value="{{isset($recurso) ? 'RECUSAR RECURSO' : 'REPROVAR'}}">
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/dashboard/tabela.js')}}" defer></script>
@endpush
