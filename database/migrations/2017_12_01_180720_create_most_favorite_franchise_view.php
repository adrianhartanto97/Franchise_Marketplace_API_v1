<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMostFavoriteFranchiseView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW view_most_favorite_franchise AS
                        select 
count(*) as nums_favorite,franchise_id,banner,logo,category,`type`,establishSince,investment,franchiseFee,website,address,location,phoneNumber,email,averageRating,detail
from dbfranchise_api.view_favorite group by franchise_id,banner,logo,category,`type`,establishSince,investment,franchiseFee,website,address,location,phoneNumber,email,averageRating,detail order by nums_favorite desc");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_most_favorite_franchise");
    }
}
