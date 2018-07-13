<?php

namespace InscricoesMonitoria\Http\Controllers;

use InscricoesMonitoria\Models\ConfiguraInscricao;

use View;



/**
* Classe base.
*/

class BaseController extends Controller
{

	public $periodo_inscricao;

	public function __construct() {

       $monitoria = new ConfiguraInscricao();

	   $periodo_inscricao = $monitoria->retorna_periodo_inscricao();

       View::share ( 'periodo_inscricao', $periodo_inscricao );
    }  
}
