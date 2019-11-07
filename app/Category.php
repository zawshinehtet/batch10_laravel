<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //  model and table insert load lo ya
    protected $fillable = [
        'name'
    ];
    public function posts()
    {
    	return $this->hasMany('App\Post');
    }
}
