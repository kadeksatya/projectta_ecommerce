<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'product';

    protected $fillable = [
        'name',
        'photo',
        'category_id',
        'variant_id',
        'unit_id',
        'stock_id',
        'cost_price',
        'sales_price',
        'is_active',
        'remark',

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
}
