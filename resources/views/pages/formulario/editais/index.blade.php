<hr class="w-100">
<div class="card">
    <div class="card-header">
        <h4 class="card-title font-weight-bold">LISTA DE EDITAIS</h4>
        @include('pages.formulario.editais.create')
    </div>
    <div class="card-body">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-12 col-md-12">
                <table id="dataTable" width="100%">
                    <thead>
                    <tr>
                        <th>NOME</th>
                        <th>DOCUMENTO</th>
                        <th>DESCRIÇÃO</th>
                        <th class="text-right">AÇÕES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($formulario->editais as $edital)
                        <tr>
                            <td>{{ucfirst($edital->titulo)}}</td>
                            <td>
                                <a href="{{asset('storage/'.$edital->documento)}}" target="_black">ABRIR DOCUMENTO</a>
                            </td>
                            <td>{{ucfirst($edital->descricao)}}</td>
                            <td class="text-right">
                                <a href="#" class="btn btn-danger btn-sm delete_item_sweet" data-action="{{route('editail.destroy', $edital->id)}}" title="REMOVER DOCUMENTO">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>NOME</th>
                        <th>DOCUMENTO</th>
                        <th>DESCRIÇÃO</th>
                        <th>AÇÕES</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
