<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resets', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->unsignedBigInteger('kuis_id');
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::table('resets', function (Blueprint $table){
            $table->foreign('kuis_id')->references('id')->on('kuis')->onDelete('cascade');
        });

        Schema::table('resets', function (Blueprint $table){
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });

        Schema::table('resets', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resets');
    }
}
