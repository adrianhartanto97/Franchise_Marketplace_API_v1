<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brochure extends Model
{
    protected $fillable = [
        'franchise_id', 'brochure'
    ];
    
    protected $table = 'brochures';
}
