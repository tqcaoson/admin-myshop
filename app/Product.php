<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    public function product_type(){
    	return $this->belongsTo('App\ProductType', 'id_type', 'id');
    }
    public function bill_detail(){
    	return $this->hasMany('App\BillDetail', 'id', 'id_product');
    }
    public function anh(){
    	return $this->belongsTo('App\Images', 'id', 'id_product');
    }
}
