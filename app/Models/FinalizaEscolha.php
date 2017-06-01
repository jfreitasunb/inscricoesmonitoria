<?php

namespace Monitoriamat\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class FinalizaEscolha extends Model
{
    protected $primaryKey = 'id_user';

    protected $table = 'finaliza_escolhas';

    protected $fillable = [
        'tipo_monitoria',
        'concorda_termos',
    ];
}
