<?php

namespace Monitoriamat\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nome',
        'login', 
        'email', 
        'password',
        'validation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function verified()
{
    $this->verified = 1;
    $this->email_token = null;
    $this->save();
}
}
