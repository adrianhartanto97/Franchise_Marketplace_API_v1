<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranchiseeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchisee', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id',10);
            $table->string('franchise_id',10);
            $table->string('agreement_franchisor_franchisee',255);
            $table->string('status_verified',30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('franchisee');
    }
}
