<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventBookView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW view_event_book AS
                       select
        a.user_id, a.event_id, a.qrcode, a.amount, 
        b.franchise_id, b.name, b.date, b.time, b.venue, b.detail, b.image, b.price, b.status
    from
        dbfranchise_api.discount a inner join dbfranchise_api.event b on
        a.event_id = b.id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_event_book");
    }
}
