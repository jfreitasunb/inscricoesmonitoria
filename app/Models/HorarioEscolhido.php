<?php

namespace Monitoriamat\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class HorarioEscolhido extends Model
{
    protected $primaryKey = 'id_user';

    protected $table = 'Horario_escolhido';

    protected $fillable = [
        'horario_monitoria',
        'dia_semana',
    ];
}
