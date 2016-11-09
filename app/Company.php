<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'address', 'user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function invoice(){
        return $this->hasMany('App\Invoice');
    }
}
