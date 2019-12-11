<?php

namespace App\Resturant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model 
{

    protected $table = 'payment_methods';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name');

    public function orders()
    {
        return $this->hasMany('App\General\Order');
    }

}