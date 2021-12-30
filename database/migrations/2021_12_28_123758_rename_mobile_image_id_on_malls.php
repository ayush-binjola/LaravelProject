<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMobileImageIdOnMalls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('malls', function (Blueprint $table) {
            //
            $table->foreign('mobileImageId')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('landscapeImageId')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('portraitImageId')->references('id')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('malls', function (Blueprint $table) {

        });
    }
}
