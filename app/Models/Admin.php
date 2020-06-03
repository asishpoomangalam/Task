<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticate;
//use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticate
{
    use Notifiable;
 
    protected $guard = 'admin';
 
    protected $fillable = [
        'name', 'email', 'password',
    ];
 
    protected $hidden = [
        'password', 'remember_token',
    ];
}
