<div class="card" style="width: 100%">
    <div class="card-header bg-info">
        <h5 class="card-title text-white font-weight-bold">INFORMAÇÕES PESSOAIS</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col col-12 col-md-6 col-lg-6 has-info">
                <label for="nome" class="font-weight-bold">NOME </label>
                <input type="text" class="form-control font-weight-bold" id="nome"
                       value="{{mb_strtoupper($formulariUsuario->user->pessoa->nome_completo)}}" disabled>
            </div>

            <div class="col col-12 col-md-6 col-lg-6 has-info">
                <label for="cpf" class="font-weight-bold">CPF </label>
                <input type="text" class="form-control font-weight-bold" id="cpf"
                       value="{{mb_strtoupper($formulariUsuario->user->pessoa->cpf)}}" disabled>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col col-12 col-md-6 col-lg-6 has-info">
                <label for="data_nascimento" class="font-weight-bold">DATA DE NASCIMENTO </label>
                <input type="date" class="form-control font-weight-bold" id="data_nascimento"
                       value="{{mb_strtoupper($formulariUsuario->user->pessoa->data_nascimento)}}" disabled>
            </div>

            <div class="col col-12 col-md-6 col-lg-6 has-info">
                <label for="rg" class="font-weight-bold">RG </label>
                <input type="text" class="form-control font-weight-bold" id="rg"
                       value="{{mb_strtoupper($formulariUsuario->user->pessoa->rg)}}" disabled>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col col-12 col-md-6 col-lg-6 has-info">
                <label for="orgao_expedidor" class="font-weight-bold">ÓRGÃO EXPEDIDOR </label>
                <input type="text" class="form-control font-weight-bold" id="data_nascimento"
                       value="{{mb_strtoupper($formulariUsuario->user->pessoa->orgao_emissor)}}" disabled>
            </div>

            <div class="col col-12 col-md-6 col-lg-6 has-info">
                <label for="rg" class="font-weight-bold">EMAIL </label>
                <input type="text" class="form-control font-weight-bold" id="rg"
                       value="{{mb_strtoupper($formulariUsuario->user->pessoa->email)}}" disabled>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col col-12 col-md-6 col-lg-6 has-info">
                <label for="nacionalidade" class="font-weight-bold">NASCIONALIDADE </label>
                <input type="text" class="form-control font-weight-bold" id="nacionalidade"
                       value="{{empty($formulariUsuario->user->pessoa->nacionalidade) ? 'NÃO INFORMADO' : mb_strtoupper($formulariUsuario->user->pessoa->nacionalidade)}}"
                       disabled>
            </div>

            <div class="col col-12 col-md-6 col-lg-6 has-info">
                <label for="naturalidade" class="font-weight-bold">NATURALIDADE </label>
                <input type="text" class="form-control font-weight-bold" id="naturalidade"
                       value="{{empty($formulariUsuario->user->pessoa->naturalidade) ? 'NÃO INFORMADO' : mb_strtoupper($formulariUsuario->user->pessoa->naturalidade)}}"
                       disabled>
            </div>
        </div>
        <hr>
        <div class="row mt-4">
            <div class="col col-12 col-md-6 col-lg-6 has-info">
                <label for="bairro" class="font-weight-bold">BAIRRO </label>
                <input type="text" class="form-control font-weight-bold" id="bairro"
                       value="{{empty($formulariUsuario->user->pessoa->endereco->bairro) ? 'NÃO INFORMADO' : mb_strtoupper($formulariUsuario->user->pessoa->endereco->bairro)}}"
                       disabled>
            </div>

            <div class="col col-12 col-md-6 col-lg-6 has-info">
                <label for="rua" class="font-weight-bold">RUA </label>
                <input type="text" class="form-control font-weight-bold" id="rua"
                       value="{{empty($formulariUsuario->user->pessoa->endereco->rua) ? 'NÃO INFORMADO' : mb_strtoupper($formulariUsuario->user->pessoa->endereco->rua)}}"
                       disabled>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col col-12 col-md-6 col-lg-6 has-info">
                <label for="numero" class="font-weight-bold">NÚMERO </label>
                <input type="text" class="form-control font-weight-bold" id="numero"
                       value="{{empty($formulariUsuario->user->pessoa->endereco->numero) ? 'NÃO INFORMADO' : mb_strtoupper($formulariUsuario->user->pessoa->endereco->numero)}}"
                       disabled>
            </div>

            <div class="col col-12 col-md-6 col-lg-6 has-info">
                <label for="cep" class="font-weight-bold">CEP </label>
                <input type="text" class="form-control font-weight-bold" id="cep"
                       value="{{empty($formulariUsuario->user->pessoa->endereco->cep) ? 'NÃO INFORMADO' : mb_strtoupper($formulariUsuario->user->pessoa->endereco->cep)}}"
                       disabled>
            </div>
        </div>
        @if(!is_null($formulariUsuario->user->pessoa->endereco->complemento))
            <div class="row mt-4">
                <div class="col col-12 col-md-12 col-lg-12 has-info">
                    <label for="complemento" class="font-weight-bold">COMPLEMENTO </label>
                    <input type="text" class="form-control font-weight-bold" id="complemento"
                           value="{{empty($formulariUsuario->user->pessoa->endereco->complemento) ? 'NÃO INFORMADO' : mb_strtoupper($formulariUsuario->user->pessoa->endereco->complemento)}}"
                           disabled>
                </div>
            </div>
        @endif
    </div>
</div>



