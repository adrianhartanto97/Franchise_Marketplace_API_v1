<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranchiseeReviewRatingView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW view_franchisee_review_rating AS
                       select
        a.id as franchisee_id,
        a.user_id,
        c.name,
        c.email,
        c.image,
        a.franchise_id,
        b.id as review_rating_id,
        b.rating,
        b.review,
        b.created_at
    from
        dbfranchise_api.franchisee a inner join dbfranchise_api.review_rating b on
        a.id = b.franchisee_id inner join dbfranchise_api.users c on a.user_id = c.id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_franchisee_review_rating");
    }
}
