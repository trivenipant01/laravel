<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $fillable = array('name', 'slug', 'body');
	public function tags() {
		return $this->belongsToMany('App\Tag');	
	}
}
