<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Poll_answer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'poll_answer';
	protected $dateFormat = 'Y-m-d h:i:s';
    protected $fillable = [
       'fk_question_id', 'answer'
    ];

    
}