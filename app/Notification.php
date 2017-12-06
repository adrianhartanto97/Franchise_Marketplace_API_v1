<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'franchise_id','statusRead'
    ];
    
    protected $table = 'notification';
}
