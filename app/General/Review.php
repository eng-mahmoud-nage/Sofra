<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model 
{

    protected $table = 'reviews';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('status', 'restaurant_id', 'comment', 'client_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant\Restaurant', 'restaurant_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Client\Client', 'client_id');
    }

}