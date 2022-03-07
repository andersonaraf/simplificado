<form method="post" action="{{route('cargo.store')}}">
    @csrf
    <input type="hidden" name="escolaridade" value="{{$escolaridade->id}}">
    <input type="hidden" name="formularioID" value="{{$formulario->id}}">
    <div class="row">
        <div class="col col-12 col-lg-12 col-md-12">
            <div class="form-group has-warning">
                <input type="text" class="form-control text-dark font-weight-bold" name="nomeCargo"
                       placeholder="NOME DO CARGO" required>
            </div>
        </div>
        <div class="col col-6 col-lg-6 col-md-6">
            <div class="form-group has-info">
                <textarea type="text" class="form-control text-dark font-weight-bold" name="informativo" placeholder="INFORMAÇÃO SOBRE O CAMPO, MÁXIMO 1000 CARACTERES." maxlength="1000"></textarea>
                <span id="limiteCaracter">1000 caracteres</span>
            </div>
        </div>
        <div class="col col-6 col-lg-6 col-md-6 text-md-right text-lg-right">
            <input type="submit" class="btn btn-outline-info" value="CRIAR">
        </div>
    </div>
</form>
