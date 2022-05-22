<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Stock;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use SoftDeletes;

    protected $table = 'varian';

    protected $guarded = [];

    protected $appends =[
        'stock_total'
    ];

    public function getStockTotalAttribute()
    {
        $totals = Stock::where('variant_id', $this->id);

        $totals = $totals->sum('stock_in') - $totals->sum('stock_out');
        return $totals;
    }

    /**
     * Get the product that owns the Variant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo('App\Product', 'product_id');
    }


    /**
     * Get the stocks that owns the Variant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stocks(): BelongsTo
    {
        return $this->belongsTo('App\Stock','stock_id');
    }
}
