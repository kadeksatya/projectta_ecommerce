<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ongkir extends Model
{
    use SoftDeletes;

    protected $table = 'ongkir';

    protected $fillable = [
        'name',
        'value',
    ];
}
