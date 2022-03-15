<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;

    protected $table = 'stock';

    protected $fillable = [
        'product_id',
        'stock_in',
        'stock_out',

    ];
}
