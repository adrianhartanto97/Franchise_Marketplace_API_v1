<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    protected $fillable = [
        'name', 'logo', 'banner', 'category', 'type', 'establishSince', 'investment', 'franchiseFee', 'website', 'address', 'location', 'phoneNumber', 'email', 'averageRating', 'detail'
    ];
    
    protected $table = 'franchise_list';
}
