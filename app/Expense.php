<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * Define which model attributes are mass assignable
     * @var array
     */

    protected $fillable = ['type', 'name', 'date' , 'amount', 'company_id', 'user_id'];

    /**
     * Get the Company that expense belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function company(){
        return $this->belongsTo('App\Company');
    }

    /**
     * Get the User that created expense
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user(){
        return $this->belongsTo('App\User');
    }

}
