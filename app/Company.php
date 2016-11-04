<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'address'];

    public function user(){
        return $this->hasOne('App\User', 'user_id' , 'id');
    }
}
