<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review_Rating extends Model
{
    protected $fillable = ['franchisee_id', 'rating','review'
    ];
    
    protected $table = 'review_rating';
}
