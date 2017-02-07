<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['last_name', 'first_name', 'address'];

    public function getFullNameAttribute(){
    	return ucfirst($this->last_name) . ', ' . ucfirst($this->first_name);
    }

    public function orders(){
    	return $this->hasMany('App\Order');
    }
}
