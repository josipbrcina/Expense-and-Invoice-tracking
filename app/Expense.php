<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['type', 'name', 'amount', 'company_id', 'user_id'];

    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
