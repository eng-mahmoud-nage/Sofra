<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model 
{

    protected $table = 'transactions';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('restaurant_id', 'paid', 'residual');

    public function orders()
    {
        return $this->belongsTo('App\General\Order', 'order_id');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant\Restaurant', 'restaurant_id');
    }

}