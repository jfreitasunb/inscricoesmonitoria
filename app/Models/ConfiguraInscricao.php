<?php

namespace Monitoriamat\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class ConfiguraInscricao extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $primaryKey = 'id_monitoria';

    protected $table = 'configura_monitoria';

    protected $fillable = [
        'ano_monitoria',
        'semestre_monitoria', 
        'inicio_inscricao', 
        'fim_inscricao',
    ];

    public function retorna_inscricao_ativa()
    {
        $monitoria_ativa = $this->get()->sortByDesc('id_monitoria')->first();

        return $monitoria_ativa;

    }

    public function retorna_periodo_inscricao()
    {

        $inicio = Carbon::createFromFormat('Y-m-d', $this->retorna_inscricao_ativa()->inicio_inscricao);
        $fim = Carbon::createFromFormat('Y-m-d', $this->retorna_inscricao_ativa()->fim_inscricao);

        $data_hoje = (new Carbon())->format('Y-m-d');
        
        $data_inicio = $inicio->format('Y-m-d');
        $data_fim = $fim->format('Y-m-d');


        if ($data_hoje >= $data_inicio && $data_hoje <= $data_fim) {
            return $periodo_inscricao = $inicio->format('d/m/Y')." à ".$fim->format('d/m/Y');
        }

        if ($data_hoje < $data_inicio) {
            return $periodo_inscricao = "A inscrição não está aberta";
        }

        if ($data_hoje > $data_fim) {
            return $periodo_inscricao = "Inscrições encerradas.";
        }
    }

    public function autoriza_inscricao()
    {
        $data_inicio = Carbon::createFromFormat('Y-m-d', $this->retorna_inscricao_ativa()->inicio_inscricao);
        $data_fim = Carbon::createFromFormat('Y-m-d', $this->retorna_inscricao_ativa()->fim_inscricao);

        $data_hoje = (new Carbon())->format('Y-m-d');

        if ($data_hoje >= $data_inicio && $data_hoje <= $data_fim) {
            return true;
        }else{
            return false;
        }
    }
}
