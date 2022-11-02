<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Poll_question extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'poll_question';
	protected $dateFormat = 'Y-m-d h:i:s';
    protected $fillable = [
       'poll_question', 'description', 'multiple_checking','unique_checking','status','created_on','closing_date'
    ];

    
}