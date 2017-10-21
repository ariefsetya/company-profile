<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcontents extends Model
{
    public function contents()
	{
	    return $this->belongsTo('App\Contents', 'content_id');
	}
}
