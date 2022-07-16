<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class HasRatings extends Model
{
    use SoftDeletes;

    protected $table = 'has_ratings';

    protected $guarded = [

    ];

    public function detailRatings(): HasMany
    {
        return $this->hasMany('App\Rating', 'id','rating_id');
    }
    public function productsRating(): HasMany
    {
        return $this->hasMany('App\Product', 'id','product_id');
    }
    public function userCustomerRatings(): HasMany
    {
        return $this->hasMany('App\Product', 'id','customer_id');
    }
}
