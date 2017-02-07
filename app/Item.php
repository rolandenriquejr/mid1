<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

	public function getFullNameAttribute(){
    	return ucfirst($this->item_name);
    }

    public function orders(){
    	return $this->belongsTo('App\OrderDetail');
    }
}
