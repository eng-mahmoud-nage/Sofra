<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('title', 'content', 'order_id');

    public function order()
    {
        return $this->belongsTo('App\General\Order', 'order_id');
    }

    public function restaurant()
    {
        return $this->morphMany('App\Restaurant\Restaurant', 'resturantable');
    }

    public function client()
    {
        return $this->morphMany('App\Client\Client', 'clientable');
    }

}