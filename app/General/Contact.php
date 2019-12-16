<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{

    protected $table = 'contacts';
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'email', 'phone', 'message', 'type'); // ,'contactable_id', 'contactable_type'

//    public function restaurants()
//    {
//        return $this->morphTo();
//    }
//
//    public function clients()
//    {
//        return $this->morphTo();
//    }

}
