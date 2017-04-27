<?php

namespace Monitoriamat\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class DisciplinaMat extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $primaryKey = 'id';

    protected $table = 'disciplinas_mat';

    protected $fillable = [
        'codigo',
        'nome', 
        'creditos',
    ];

    public function pega_disciplinas_monitoria()
    {
    
        $disciplinas_para_monitoria = $this->select('codigo', 'nome')->orderBy('nome')->get();

      //   $disciplinas = DB::table('disciplinas_mat')
            // ->select('codigo', 'name')
            // ->join('disciplinas_disponiveis', 'codigo', '=', 'codigo_disciplina')
            // ->where('id_monitoria', $id_monitoria_ativa)
            // ->get();

        return $disciplinas_para_monitoria;
    }
}