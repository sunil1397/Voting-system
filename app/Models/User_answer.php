<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User_answer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'user_answer';
	protected $dateFormat = 'Y-m-d h:i:s';
    protected $fillable = [
       'email', 'physical_device_id', 'fk_question_id', 'fk_answer_id', 'created_at', 'updated_at'
    ];

    
}