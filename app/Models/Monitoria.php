<?php

namespace Monitoriamat\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Monitoria extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $primaryKey = 'id_monitoria';

    
    public static function retorna_monitoria_ativa()
    {
        $monitoria_ativa = DB::table('configura_monitoria')->orderby('id_monitoria', 'desc')->first();

        $data_inicio = Carbon::createFromFormat('Y-m-d', $monitoria_ativa->inicio_inscricao);
        $data_fim = Carbon::createFromFormat('Y-m-d', $monitoria_ativa->fim_inscricao);

        $periodo_inscricao = $data_inicio->format('d/m/Y')." à ".$data_fim->format('d/m/Y');

        return $periodo_inscricao;
    }
}
