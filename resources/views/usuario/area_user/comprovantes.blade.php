@extends('layouts.header-footer')

@section('lista')
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
                        <th>Comprovante</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($formularioUsuarios as $formuser)
                        <tr class="table-striped">
                            <td>{{$formuser->formulario->nome}}</td>
                            <td>{{$formuser->cargo->cargo}}</td>
                            <td>{{$formuser->comprovante->comprovante}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('js/dashboard/tabela.js')}}" defer></script>
    {{--    DELETAR FORMULÁRIO--}}
    {{--    <script src="{{asset('js/confirmaDelete.js')}}"></script>--}}
@endpush
