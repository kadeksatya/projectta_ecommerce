<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariantPhoto extends Model
{
    use SoftDeletes;
    protected $guaded = [];
}
