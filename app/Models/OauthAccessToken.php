<?php

namespace App\Models;

use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class OauthAccessToken extends Model
{
    use HasFactory;
    protected $connection = "mongodb";
    protected $guarded= [];
}
