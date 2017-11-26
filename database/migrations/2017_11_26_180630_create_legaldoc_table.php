<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegaldocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legal_doc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('franchise_id',10);
            $table->string('tdp',255)->nullable();
            $table->string('siup',255)->nullable();
            $table->string('suratperjanjian',255)->nullable();
            $table->string('stpw',255)->nullable();
            $table->string('ktpfranchisor',255)->nullable();
            $table->string('companyprofile',255)->nullable();
            $table->string('laporankeuangan2tahunterakhir',255)->nullable();
            $table->string('suratizinteknis',255)->nullable();
            $table->string('tandabuktipendaftaran',255)->nullable();
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
        Schema::dropIfExists('legal_doc');
    }
}
