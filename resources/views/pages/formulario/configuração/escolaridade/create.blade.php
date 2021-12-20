<!-- Modal Escolaridade-->
<div class="modal fade" id="modalEscolaridade" tabindex="-1" role="dialog" aria-labelledby="modalEscolaridadeTitulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{route('escolaridade.store')}}">
                @csrf
                <input type="hidden" name="formularioID" value="{{$formulario->id}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEscolaridadeTitulo">Nova Escolaridade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-12">
                            <div class="form-group has-info">
                                <label for="nomeEscolaridade">Escolaridade</label>
                                <input type="text" class="form-control mt-2" name="nomeEscolaridade" id="nomeEscolaridade" placeholder="ENSINO MÉDIO">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fecha</button>
                    <input type="submit" class="btn btn-primary" value="Criar">
                </div>
            </form>
        </div>
    </div>
</div>
