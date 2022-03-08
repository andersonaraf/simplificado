<form method="post" action="{{route('editail.store')}}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="formulario_id" value="{{$formulario->id}}">
    <div class="row">
        <div class="col col-12 col-md-12 col-lg-12">
            <hr class="w-100">
            <h5>Novo Edital / Documento Informativo</h5>
            <hr class="w-100">
        </div>

        <div class="col col-12 col-md-3 col-lg-3 has-info">
            <label for="titulo" class="text-dark font-weight-bold">Título</label>
            <input type="text" name="titulo" class="form-control" id="titulo" placeholder="TÍTULO DE EXIBIÇÃO" required>
        </div>

        <div class="col col-12 col-md-3 col-lg-4 has-info">
            <label for="descricao" class="text-dark font-weight-bold">Descrição</label>
            <input type="text" name="descricao" class="form-control" id="descricao" placeholder="DESCRIÇÃO INFORMATIVA">
        </div>
        <div class="col col-12 col-md-3 col-lg-3 has-info">
            <label for="arquivo" class="text-dark font-weight-bold">Arquivo</label>
            <input type="file" name="arquivo" class="custom-file" id="arquivo" required>
        </div>
        <div class="col col-12 col-md-3 col-lg-2 has-info">
            <label for="hierarquia" class="text-dark font-weight-bold">Hierarquia de exibição</label>
            <select type="text" name="hierarquia" class="custom-select" id="hierarquia">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>

        <div class="col col-12 col-md-12 col-lg-12 has-info text-right mt-2">
            <input type="submit" class="btn btn-outline-info w-100" value="SALVAR">
            <hr class="w-100">
        </div>
    </div>
</form>
