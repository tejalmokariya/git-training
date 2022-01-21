<?php

namespace App\Models;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    protected $with = ["ratings"];
    use HasFactory;
    protected $connection = "mongodb";
    protected $guarded= [];

        /**
     * Get the reviews of the product.
     */
    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }



   

    
}
