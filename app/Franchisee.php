<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Franchisee extends Model
{
    protected $fillable = [
        'user_id', 'franchise_id', 'agreement_franchisor_franchisee', 'status_verified'
    ];
    
    protected $table = 'franchisee';
}
