<?php

namespace InscricoesMonitoria\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class DadoAcademico extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'dados_academicos';

    protected $fillable = [
        'ira',
        'monitor_convidado',
        'nome_professor' ,
        'curso_graduacao',
    ];

public function retorna_dados_academicos($id_user)
    {

        return $this->where('id_user', $id_user)->orderBy('updated_at', 'DESC')->get()->first();

    }
}