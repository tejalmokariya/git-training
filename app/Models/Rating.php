<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Jenssegers\Mongodb\Eloquent\Model;

class Rating extends Model
{
   
   // protected $with = ["products"];
    protected $connection = "mongodb";
    protected $guarded= [];
    /**
     * Get the product that owns the review.
     */
    public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * Get the user that made the review.
     */
    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User');
    // }
    protected $hidden = [
        '_id',
        'updated_at',
        'created_at',
        'product_id',
       
    ];

}
