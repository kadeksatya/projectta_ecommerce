<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use SoftDeletes;

    protected $table = 'varian';

    protected $guarded = [];



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
