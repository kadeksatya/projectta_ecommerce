<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'username', 'password','role_id'
    ];
} 
