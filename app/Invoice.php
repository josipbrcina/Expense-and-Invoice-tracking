<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['due_date', 'amount', 'company_id', 'user_id'];

    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
