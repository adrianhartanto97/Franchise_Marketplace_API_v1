<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventFranchisorView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW view_event_franchisor AS
                       select
        a.id as event_id,
        a.franchise_id,
        a.name,
        a.date,
        a.time, a.venue, a.detail, a.image, a.price, a.status, b.id as franchisor_id, b.user_id
    from
        dbfranchise_api.event a inner join dbfranchise_api.franchisor b on
        a.franchise_id = b.id");
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
