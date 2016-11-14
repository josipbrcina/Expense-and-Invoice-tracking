<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * Define which model attributes are mass assignable
     * @var array
     */

    protected $fillable = ['due_date', 'amount', 'company_id', 'user_id'];

    /**
     * Get the Company that invoice belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function company(){
        return $this->belongsTo('App\Company');
    }

    /**
     * Get the User that created invoice
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user(){
        return $this->belongsTo('App\User');
    }
}
