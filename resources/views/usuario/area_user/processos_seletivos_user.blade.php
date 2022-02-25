@extends('layouts.header-footer')

@section('lista')

    {{--    VERIFICA SE O USUÁRIO ESTÁ PARTICIPANDO DE ALGUM PROESSO SELETIVO--}}
    @if(isset($formularioUsuario))
        <div class="container">
            <div class="py-5">
                <div class="col- 12 col-md-12 col-lg-12 col-sm-12 card card-header bg-primary py-4">
                    {{--APENAS DIV ESTETICA PARA LAYOUT--}}
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-sm-12 card card-body">

                    <table id="dataTable" class=" table-bordered table table-responsive-lg table-hover">

                    <thead class="thead-dark">
                        <tr>
                            <th>Processo</th>
                            <th>Cargo</th>
                            <th>Data Inscrição</th>
                            <th class="text-right">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($formularioUsuario as $formuser)
                            <tr class="table-striped">
                                <td>{{$formuser->formulario->nome}}</td>
                                <td>{{$formuser->cargo->cargo}}</td>
                                <td>{{date('d/m/Y',strtotime($formuser->created_at)  )}}</td>
                                <td class="text-right">
                                    <a href="{{route('usuario.view.processos',[Auth::user()->id,$formuser->formulario->id])}}">
                                        <button type="button" class="btn btn-info">Vizualizar</button>
                                    </a>
                                    @if($formuser->formulario->liberar_recurso == 1 || (strtotime($formuser->data_liberar_recurso) >= strtotime(date('Y-m-d H:i:s')) && strtotime($formuser->formulario->data_fecha_recurso) <= strtotime(date('Y-m-d H:i:s'))))
                                        <a href="{{route('usuario.recurso')}}">
                                            <button type="button" class="btn btn-warning">Recurso</button>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div id="mensagem">
                        {{--MENSAGEM DE ALERTA AQUI AO CLICKAR NO NO BOTÃO DE RECURSO, INFORMANDO USUÁRIO!--}}
                    </div>
                </div>
            </div>
        </div>
        </div>

    @endif
    {{--    TELA QUANDO USUÁRIO NAO SE ESCREVEU EM NENHUM PROCESSO SELETIVO--}}
    @if(is_null($formularioUsuario))
        <div class="container">
            <div class="py-5">
                <div class="card card-header bg-primary py-4">
                    {{--APENAS DIV ESTETICA PARA LAYOUT--}}
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-sm-12 card card-body ">
                    <div class="d-flex  justify-content-center">
                        <h4 class="">Voçê ainda não se inscreveu em nenhum processo seletivo</h4>
                    </div>

                </div>
            </div>

        </div>

    @endif

@endsection
@push('script')
    <script src="{{asset('js/dashboard/tabela.js')}}" defer></script>
    {{--    DELETAR FORMULÁRIO--}}
    {{--    <script src="{{asset('js/confirmaDelete.js')}}"></script>--}}
@endpush
