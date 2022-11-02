<?php

namespace App\Models;

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
    protected $table = 'user';
	protected $dateFormat = 'Y-m-d h:i:s';
	const CREATED_AT = 'created_on';
    const UPDATED_AT = 'created_on';
    protected $fillable = [
       'name', 'email', 'password','phone_no','stauts','last_login_ip','last_login_time','user_type',
    ];

    
}