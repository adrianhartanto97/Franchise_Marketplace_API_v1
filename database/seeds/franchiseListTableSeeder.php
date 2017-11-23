<?php

use Illuminate\Database\Seeder;

class franchiseListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //delete table records
         //`DB::table('franchise_list')->delete();
         //insert some dummy records
         DB::table('franchise_list')->insert(
            [
                'name' => 'Uncledazs',
                'logo' => 'Uncledazs.jpg',
                'banner' => 'Uncledazs.jpg',
                'category' => 'Food & Beverages',
                'type' => 'Local',
                'establishSince' => '2013',
                'investment' => 15000000,
                'franchiseFee' => 20000000,
                'website' => 'www.uncledazs.com',
                'address' => 'Jl. Pangrango Raya C32 Bekasi',
                'location' => 'Jakarta',
                'phoneNumber' => '02170092299',
                'email' => 'ayambacokindonesia@gmail.com',
                'detail' => 'Ayam Bacok adalah waralaba camilan ayam goreng tanpa tulang, tanpa lemak & tanpa kulit, Ayam goreng khas taiwan yg telah diindonesiakan.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
                
            );
    }
}
