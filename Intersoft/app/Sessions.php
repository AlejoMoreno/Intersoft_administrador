<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    //
    protected $fillable = [
	    'user_id',
		'ip',
		'user_agent',
		'last_activity'
	];
}
