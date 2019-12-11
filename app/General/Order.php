<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('payment_method_id', 'notes', 'address', 'total_price', 'net', 'total_commission', 'status', 'delivery_charge', 'processing_time');

    public function products()
    {
        return $this->belongsToMany('App\General\Prouduct', 'product_id');
    }

    public function payment_method()
    {
        return $this->belongsTo('App\Resturant\PaymentMethod', 'payment_method_id');
    }

    public function transactions()
    {
        return $this->hasMany('App\General\Transaction');
    }

    public function notification()
    {
        return $this->hasOne('App/General\Notification');
    }

    public function restaurant()
    {
        return $this->morphMany('App/Restaurant\Restaurant', 'restaurantable');
    }

    public function client()
    {
        return $this->morphMany('App/Client\Client', 'clientable');
    }

}