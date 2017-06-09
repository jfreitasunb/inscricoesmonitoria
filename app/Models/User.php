<?php

namespace Monitoriamat\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Monitoriamat\Notifications\ResetPassword as ResetPasswordNotification;

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
        $this->ativo = 1;
        $this->validation_code = null;
        $this->save();
    }

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token));
    }
}
