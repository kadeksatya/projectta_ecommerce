<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banks extends Model
{
    use SoftDeletes;

    protected $table = 'bank';

    protected $fillable = [
        'name',
        'photo',
        'no_rek'
    ];
}
