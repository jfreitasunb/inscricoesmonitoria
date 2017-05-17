<?php

namespace Monitoriamat;

use Illuminate\Database\Eloquent\Model;

class DadosPessoais extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'dados_pessoais';

    protected $fillable = [
        'numerorg',
        'emissor', 
        'cpf',
        'endereco',
        'cidade',
        'cep',
        'estado',
        'telefone',
        'celular',
    ];

}
