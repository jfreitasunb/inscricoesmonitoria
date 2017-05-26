<?php

namespace Monitoriamat\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $primaryKey = 'id_user';

    protected $table = 'arquivos_enviados';

    protected $fillable = [
        'nome_arquivo',
    ];

}
