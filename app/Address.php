<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $table = 'address';

    protected $fillable = [
        'customer_id',
        'name',
        'address',
        'remark'

    ];
}
