<?php

namespace Monitoriamat\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Monitoria extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $primaryKey = 'id_monitoria';

    protected $fillable = [
        'ano_monitoria',
        'semestre_monitoria', 
        'inicio_inscricao', 
        'fim_inscricao',
    ];

    public function retorna_monitoria_ativa()
    {
        $monitoria_ativa = DB::table('configura_monitoria')->orderby('id_monitoria', 'desc')->first();

        return $monitoria_ativa;

    }

    public function retorna_periodo_inscricao()
    {
        // $monitoria_ativa = new Monitoria();

        $data_inicio = Carbon::createFromFormat('Y-m-d', $this->retorna_monitoria_ativa()->inicio_inscricao);
        $data_fim = Carbon::createFromFormat('Y-m-d', $this->retorna_monitoria_ativa()->fim_inscricao);

        $data_hoje = (new Carbon())->format('Y-m-d');

        if ($data_hoje >= $data_inicio && $data_hoje <= $data_fim) {
            return $periodo_inscricao = $data_inicio->format('d/m/Y')." à ".$data_fim->format('d/m/Y');
        }

        if ($data_hoje < $data_inicio) {
            return $periodo_inscricao = "Inscrições não está aberta";
        }

        if ($data_hoje > $data_fim) {
            return $periodo_inscricao = "Inscrições encerradas.";
        }
    }
}
