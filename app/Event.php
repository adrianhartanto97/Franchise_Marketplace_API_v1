<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['franchise_id',
            'name',
            'date',
            'time',
            'venue',
            'detail',
            'image',
            'price', 'status'
    ];
    
    protected $table = 'event';
}
