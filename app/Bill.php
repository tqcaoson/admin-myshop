<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "bill";
    public function bill_detai(){
    	return $this->hasMany('App/BillDetail', 'id', 'id_bill');
    }
    public function customer(){
    	return $this->belongsTo('App/User', 'id_customer', 'id');
    }
}
