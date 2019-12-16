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
    protected $fillable = array('payment_method_id', 'notes', 'address',
        'coast', 'net', 'commission', 'status',
        'restaurant_id', 'client_id', 'total' ,'delivery_charge');

    public function products()
    {
        return $this->belongsToMany('App\General\Product')
            ->withPivot('price', 'quantity', 'note');
    }

    public function payment_method()
    {
        return $this->belongsTo('App\Restaurant\PaymentMethod', 'payment_method_id');
    }

    public function transactions()
    {
        return $this->hasMany('App\General\Transaction');
    }

    public function notification()
    {
        return $this->hasOne('App\General\Notification');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurants\Restaurant', 'restaurant_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Client\Client', 'client_id');
    }

    public function restaurants()
    {
        return $this->belongsTo('App\Client\Client', 'restaurant_id');
    }

}
