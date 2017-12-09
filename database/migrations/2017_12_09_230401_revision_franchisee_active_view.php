<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RevisionFranchiseeActiveView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW view_franchisee_active AS
                        select
	a.id as franchisee_id,
	a.user_id,
	a.franchise_id,
	a.agreement_franchisor_franchisee,
    b.id as outlet_id,
	b.address,
	b.telp,
	b.name,
	b.date_join,
	b.created_at
from
	dbfranchise_api.franchisee a inner join dbfranchise_api.outlet b on
	a.id = b.franchisee_id
where
	a.status_verified = 'active'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_franchisee_active");
    }
}
