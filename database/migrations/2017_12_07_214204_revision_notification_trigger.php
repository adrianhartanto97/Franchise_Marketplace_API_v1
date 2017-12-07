<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RevisionNotificationTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        DB::unprepared("
        CREATE OR REPLACE TRIGGER tr_notification_insert AFTER INSERT ON brochures FOR EACH ROW
        BEGIN
         DELETE FROM notification where franchise_id = NEW.franchise_id;
         INSERT INTO notification (user_id, franchise_id, statusRead , created_at, updated_at) 
         SELECT user_id, franchise_id, 'false' as statusRead, now() as created_at, now() as updated_at FROM dbfranchise_api.favorite WHERE franchise_id = NEW.franchise_id;
        END
        ");
        
        DB::unprepared("
        CREATE OR REPLACE TRIGGER tr_notification_update AFTER UPDATE ON brochures FOR EACH ROW 
        BEGIN
         DELETE FROM notification where franchise_id = NEW.franchise_id;
         INSERT INTO notification (user_id, franchise_id, statusRead , created_at, updated_at) 
         SELECT user_id, franchise_id, 'false' as statusRead, now() as created_at, now() as updated_at FROM dbfranchise_api.favorite WHERE franchise_id = NEW.franchise_id;
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
        DB::unprepared("DROP TRIGGER IF EXISTS tr_notification_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS tr_notification_update");
    }
}
