<?php

namespace InscricoesMonitoria\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{

    protected $fillable = ['nome', 'estado_id'];

    public $timestamps = false;

    public function estado()
    {
        return $this->belongsTo('InscricoesMonitoria\Models\Estado');
    }

}
