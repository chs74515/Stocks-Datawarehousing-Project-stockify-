<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable =
        [
            'name',
            'date',
            'open',
            'high',
            'low',
            'close',
            'volume',
            'dividend',
            'split'
        ];
}
