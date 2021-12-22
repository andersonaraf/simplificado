<div class="modal fade" id="novoCollapse" tabindex="-1" role="dialog" aria-labelledby="novoCollapseLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{route('collapse.store')}}">
                @csrf
                <input type="hidden" name="cargo_id" value="{{$cargo->id}}">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="novoCollapseLabel">NOVO CAMPO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group has-info">
                        <label for="nomeCollapse">NOME: </label>
                        <input type="text" class="form-control" name="nomeCollapse" id="nomeCollapse">
                        @error('nomeCollapse')
                        <div class="alert alert-danger font-weight-bold" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Fecha</button>
                    <input type="submit" class="btn btn-primary" value="Criar">
                </div>
            </form>
        </div>
    </div>
</div>
