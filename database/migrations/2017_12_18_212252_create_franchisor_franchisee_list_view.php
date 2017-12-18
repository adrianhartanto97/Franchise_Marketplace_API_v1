<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranchisorFranchiseeListView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW view_franchisor_franchisee_list AS
            select
            'Franchisor' as status,
            a.user_id,
            b.id as franchise_id,
            b.name,
            b.logo,
            b.banner,
            b.category,
            b.`type`,
            b.establishSince,
            b.investment,
            b.franchiseFee,
            b.website,
            b.address,
            b.location,
            b.phoneNumber,
            b.email,
            b.averageRating,
            b.detail,
            b.status as status_verified,
            a.created_at
        from
            dbfranchise_api.franchisor a inner join dbfranchise_api.franchise_list b on
            a.franchise_id = b.id
        union all
        select
            'Franchisee' as status,
            a.user_id,
            b.id as franchise_id,
            b.name,
            b.logo,
            b.banner,
            b.category,
            b.`type`,
            b.establishSince,
            b.investment,
            b.franchiseFee,
            b.website,
            b.address,
            b.location,
            b.phoneNumber,
            b.email,
            b.averageRating,
            b.detail,
            b.status as status_verified,
            a.created_at
        from
            dbfranchise_api.franchisee a inner join dbfranchise_api.franchise_list b on
            a.franchise_id = b.id
            order by created_at
	   ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_franchisor_franchisee_list");
    }
}
