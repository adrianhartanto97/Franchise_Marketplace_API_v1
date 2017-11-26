<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriteView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW view_favorite AS
                        SELECT a.user_id,a.franchise_id,b.name,b.banner,b.logo,b.category,b.`type`,b.establishSince,b.investment,b.franchiseFee,b.website,b.address,b.location,b.phoneNumber,b.email,b.averageRating,b.detail
FROM dbfranchise_api.favorite a inner join dbfranchise_api.franchise_list b on
	a.franchise_id = b.id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_favorite");
    }
}
