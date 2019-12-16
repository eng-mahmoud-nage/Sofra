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
    protected $fillable = array('title', 'content', 'order_id', 'notifable_id', 'notifable_type');

    public function order()
    {
        return $this->belongsTo('App\General\Order', 'order_id');
    }

    public function restaurants()
    {
        return $this->morphTo();
    }

    public function clients()
    {
        return $this->morphTo();
    }

}
