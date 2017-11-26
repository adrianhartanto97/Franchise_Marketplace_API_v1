<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id', 'franchise_id'
    ];
    
    protected $table = 'favorite';
}
