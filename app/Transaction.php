<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $table = 'transaction';

    protected $guarded = [
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    protected static function boot()
    {
        parent::boot();




    }

    /**
     * Get the bank that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo('App\Banks', 'bank_id');
    }

    /**
     * Get the ongkir that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ongkir(): BelongsTo
    {
        return $this->belongsTo('App\Ongkir', 'ongkir_id');
    }

    /**
     * Get the address that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo('App\Address', 'address_id');
    }

        /**
     * Get the customer that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    /**
     * Get all of the trancation_details for the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction_details(): HasMany
    {
        return $this->hasMany('App\TransactionDetail', 'trx_id');
    }

}
