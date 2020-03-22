<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = "comments";
    public function user()
    {
    	return $this->belongsTo('App\nguoidung','id_user','id');
    }
    public function product()
    {
    	return $this->belongsTo('App\Product','id_product','id');
    }
}
