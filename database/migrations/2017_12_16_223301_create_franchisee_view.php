<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranchiseeView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW view_franchisee AS
                        select
	a.id as franchisee_id,
	a.user_id, c.email, a.franchise_id,a.agreement_franchisor_franchisee,a.status_verified,
	b.address,b.telp, b.name,b.date_join
from
	dbfranchise_api.franchisee a inner join dbfranchise_api.outlet b on
	a.id = b.franchisee_id inner join dbfranchise_api.users c on a.user_id = c.id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_franchisee");
    }
}
