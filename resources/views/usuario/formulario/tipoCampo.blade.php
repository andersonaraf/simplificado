@if($campo->tipoCampo->tipo == 'Texto')
    <div class="row mb-2">
        <label for="{{$campo->atributos->attr_id}}">{{strtoupper($campo->nome)}}:</label>
        <input type="text" class="form-control" id="{{$campo->atributos->attr_id}}" name="{{$campo->atributos->name}}"
               placeholder="{{!is_null($campo->atributos->placeholder) ? $campo->atributos->placeholder : ''}}"
            {{$campo->atributos->required == 1 ? 'required' : ''}}>
    </div>
@endif

@if($campo->tipoCampo->tipo == 'Arquivo')
    <div class="row mb-2">
        <label for="{{$campo->atributos->attr_id}}">{{strtoupper($campo->nome)}}:</label>
        <input type="file" class="form-control" id="{{$campo->atributos->attr_id}}" name="{{$campo->atributos->name}}"
            {{$campo->atributos->required == 1 ? 'required' : ''}}>
    </div>
@endif

@if($campo->tipoCampo->tipo == 'Selecionar')
    <div class="row mb-2">
        <label for="{{$campo->atributos->attr_id}}">{{strtoupper($campo->nome)}}:</label>
        <select class="form-control" id="{{$campo->atributos->attr}}"
                name="{{$campo->atributos->name}}" {{$campo->atributos->required == 1 ? 'required' : ''}}>

        </select>
    </div>
@endif

@if($campo->tipoCampo->tipo == 'Data')
    <div class="row mb-2">
        <label for="{{$campo->atributos->attr_id}}">{{strtoupper($campo->nome)}}:</label>
        <input type="date" class="form-control" id="{{$campo->atributos->attr_id}}" name="{{$campo->atributos->name}}"
            {{$campo->atributos->required == 1 ? 'required' : ''}}>
    </div>
@endif
