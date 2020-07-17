<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = "images";
    public function product(){
    	return $this->belongsTo('App\Product', 'id_product', 'id');
    }
}
