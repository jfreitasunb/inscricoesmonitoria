<?php

namespace Monitoriamat\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class AtuacaoMonitoria extends Model
{
    protected $primaryKey = 'id_user';

    protected $table = 'atuou_monitoria';

    protected $fillable = [
        'atuou_monitoria',
    ];

public function retorna_atuacao_monitoria($id_user)
    {
        $atuacao_monitoria = $this->find($id_user);

        return $atuacao_monitoria;

    }

}