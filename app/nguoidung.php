<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nguoidung extends Model
{
    protected $table = "users";
    public function comments()
    {
    	return $this->hasMany('App\Comments','id_user','id');
    }
}
