<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdArahBangunanToRumah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rumah', function (Blueprint $table) {
            $table->index('id_arah_bangunan');
            $table->unsignedBigInteger('id_arah_bangunan')->nullable();
            $table->foreign('id_arah_bangunan')->references('id')->on('arah_bangunan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rumah', function (Blueprint $table) {
            $table->dropForeign(['id_arah_bangunan']);
            $table->dropIndex(['id_arah_bangunan']);
            $table->dropColumn('id_arah_bangunan');
        });
    }
}
