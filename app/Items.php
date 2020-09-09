<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Items extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'image', 'price'
    ];

    protected $dates = ['deleted_at'];
}
