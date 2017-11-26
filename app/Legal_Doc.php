<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legal_Doc extends Model
{
    protected $fillable = [
       'franchise_id',
           'tdp',
           'siup',
           'suratperjanjian',
           'stpw',
           'ktpfranchisor',
           'companyprofile',
           'laporankeuangan2tahunterakhir',
           'suratizinteknis',
           'tandabuktipendaftaran',
    ];
    
    protected $table = 'legal_doc';
}
