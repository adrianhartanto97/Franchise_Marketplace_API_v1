<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['user_id', 'event_id', 'qrcode', 'amount'
    ];
    
    protected $table = 'discount';
}
