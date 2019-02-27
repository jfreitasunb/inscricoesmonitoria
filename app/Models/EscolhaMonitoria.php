<?php

namespace InscricoesMonitoria\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EscolhaMonitoria extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_user';

    protected $table = 'escolhas_candidato';

    protected $fillable = [
        'escolha_aluno',
        'mencao_aluno',
        'deleted_at'
    ];

    public function retorna_escolha_monitoria($id_user,$id_monitoria)
    {
        $escolheu_monitoria = $this->where("id_user", $id_user)->where("id_monitoria", $id_monitoria)->get();

        return $escolheu_monitoria;

    }

    public function deleta_escolhas_anterioes($id_user, $id_monitoria)
    {
        return $this->where('id_user', $id_user)->where('id_monitoria', $id_monitoria)->delete();
    }

}
