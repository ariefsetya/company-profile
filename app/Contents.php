<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    public function pages()
	{
	    return $this->belongsTo('App\Pages', 'page_id');
	}
    public function templates()
	{
	    return $this->belongsTo('App\Templates', 'template_id');
	}
}
