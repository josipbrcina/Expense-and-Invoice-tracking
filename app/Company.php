<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * Define which model attributes are mass assignable
     * @var array
     */

    protected $fillable = ['name', 'address', 'user_id'];

    /**
     * Get the user that creates Company
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * Get invoices for the Company
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function invoice(){
        return $this->hasMany('App\Invoice');
    }

    /**
     * Get expenses for the Company
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function expense(){
        return $this->hasMany('App\Expense');
    }
}
