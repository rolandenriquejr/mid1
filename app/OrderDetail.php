<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function order(){
    	$this->belongsTo('App\Oder');
    }
    
    public function items(){
    	return $this->hasMany('App\Item');
    }
}
