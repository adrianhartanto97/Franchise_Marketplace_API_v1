<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranchiselistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchise_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100)->unique();
            $table->string('logo',255);
            $table->string('banner',255);
            $table->string('category',255);
            $table->string('type',255);
            $table->string('establishSince',255)->nullable();
            $table->bigInteger('investment');
            $table->bigInteger('franchiseFee');
            $table->string('website',255)->nullable();
            $table->string('address',255);
            $table->string('location',255);
            $table->string('phoneNumber',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('averageRating',255)->nullable();
            $table->string('detail',255)->nullable();
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
        Schema::dropIfExists('franchise_list');
    }
}
