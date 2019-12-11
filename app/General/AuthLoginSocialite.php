<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthLoginSocialite extends Model
{
    protected $fillable = ['provider_id', 'provider', 'user_id'];
}
