<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'product';

    protected $guarded = [

    ];



    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo('App\Unit', 'unit_id');
    }
    public function stock(): BelongsTo
    {
        return $this->belongsTo('App\Stock', 'stock_id');
    }
    public function variant(): HasMany
    {
        return $this->hasMany('App\Variant', 'product_id');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany('App\HasRatings', 'product_id');
    }
}
