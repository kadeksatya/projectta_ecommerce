<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use SoftDeletes;


    protected $table = 'transaction_detail';

    protected $fillable = [
        'trx_id',
        'product_id',
        'qty',
        'sub_total',
        'product_price',
        'discount',
        
    ];


    protected static function boot()
    {
        parent::boot();
        // do nothing !

    }

    /**
     * Get the product that owns the TransactionDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
