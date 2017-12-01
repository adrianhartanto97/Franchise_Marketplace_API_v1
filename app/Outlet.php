<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $fillable = ['franchisee_id', 'address','telp','name','date_join'
    ];
    
    protected $table = 'outlet';
}
