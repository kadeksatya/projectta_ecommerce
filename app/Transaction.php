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

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        // do nothing !

    }


}
