<?php

namespace InscricoesMonitoria\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HorarioEscolhido extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_user';

    protected $table = 'horario_escolhido';

    protected $fillable = [
        'horario_monitoria',
        'dia_semana',
        'deleted_at',
    ];

    public function retorna_horarios_escolhidos($id_user,$id_monitoria)
    {
        $horarios = $this->where("id_user", $id_user)->where("id_monitoria", $id_monitoria)->get();

        return $horarios;

    }

    public function deleta_horarios_anterioes($id_user, $id_monitoria)
    {
        return $this->where('id_user', $id_user)->where('id_monitoria', $id_monitoria)->delete();
    }

}
