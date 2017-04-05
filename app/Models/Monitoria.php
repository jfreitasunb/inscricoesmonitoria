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

    
    public static function retorna_periodo_inscricao()
    {
        $monitoria_ativa = DB::table('configura_monitoria')->orderby('id_monitoria', 'desc')->first();

        $data_inicio = Carbon::createFromFormat('Y-m-d', $monitoria_ativa->inicio_inscricao);
        $data_fim = Carbon::createFromFormat('Y-m-d', $monitoria_ativa->fim_inscricao);

        $data_hoje = (new Carbon())->format('Y-m-d');

        if ($data_hoje >= $data_inicio && $data_hoje <= $data_fim) {
            return $periodo_inscricao = $data_inicio->format('d/m/Y')." à ".$data_fim->format('d/m/Y');
        }else{
            return $periodo_inscricao = "Inscrições encerradas ou ainda não abertas";
        }
    }
}
