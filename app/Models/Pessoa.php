<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Pessoa extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'pessoa';
    protected $fillable = [
        'id',
        'endereco_id',
        'user_id',
        'nome_completo',
        'cpf',
        'rg',
        'orgao_emissor',
        'pis',
        'nacionalidade',
        'naturalidade',
        'data_nascimento',
        'genero_id',
        'email',
        'portador_deficiencia',
    ];

    public function pessoaEditalAnexos(){
        return $this->hasMany(PessoaEditalAnexo::class, 'pessoa_id', 'id');
    }

    public function cargo(){
        return $this->hasOne(Cargo::class, 'id', 'cargo_id');
    }

    public function escolaridade(){
        return $this->hasOne(Escolaridade::class, 'id', 'escolaridade_id');
    }

    public function anexos(){
        return $this->hasOne(Anexos::class, 'id', 'anexo_id');
    }

    public function endereco(){
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }

    public function pontuacao($id){
        $pontuacao = Pontuacao::where('pessoa_id', $id)->get()->last();
        if (is_null($pontuacao)){
            return null;
        }
        return $pontuacao;
    }

    public function pontuacao2(){
       return $this->hasOne(Pontuacao::class, 'pessoa_id', 'id')->latest();
    }

    public function recurso(){
        return $this->hasOne(RecursoModel::class, 'pessoa_id', 'id');
    }

    public function reprovarPessoa($id){
        return ReprovarPessoa::where('pessoa_id', $id)->get()->last();
    }

    public function revisarPessoa($id){
        return RevisarPessoa::where('pessoa_id', $id)->get()->last();
    }

    public function reprovarMotivo(){
        return $this->hasOne(ReprovarPessoa::class, 'pessoa_id', 'id')->latest();
    }

    public function numeroContato(){
        return $this->hasMany(NumeroContato::class, 'pessoa_id', 'id');
    }
}
