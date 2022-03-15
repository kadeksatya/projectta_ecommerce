<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $table = 'transaction';

    protected $fillable = [
        'order_no',
        'customer',
        'supplier_id',
        'user_id',
        'status',
        'grand_total',
        'service_fee',
        'transaction_type',
        'remark',
        
    ];

    protected static function boot()
    {
        parent::boot();
        // do nothing !

    }


}
