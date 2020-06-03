<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticate;

use Laravel\Passport\HasApiTokens;

class Customer extends Authenticate
{
    use Notifiable,HasApiTokens;
 
    protected $guard = 'customer';
 
    protected $fillable = [
        'name', 'email', 'password',
    ];
 
    protected $hidden = [
        'password', 'remember_token',
    ];
	
}
