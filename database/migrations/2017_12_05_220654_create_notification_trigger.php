<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE OR REPLACE TRIGGER tr_notification AFTER UPDATE ON franchise_list FOR EACH ROW
        BEGIN
         DELETE FROM notification where franchise_id = NEW.id;
         INSERT INTO notification (user_id, franchise_id, statusRead , created_at, updated_at) 
         SELECT user_id, franchise_id, 'false' as statusRead, now() as created_at, now() as updated_at FROM dbfranchise_api.favorite WHERE franchise_id = NEW.id;
        END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER IF EXISTS tr_notification");
    }
}
