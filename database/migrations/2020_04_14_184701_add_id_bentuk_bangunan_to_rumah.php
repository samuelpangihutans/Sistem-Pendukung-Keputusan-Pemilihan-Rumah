<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdBentukBangunanToRumah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rumah', function (Blueprint $table) {
            $table->index('id_bentuk_bangunan');
            $table->unsignedBigInteger('id_bentuk_bangunan')->nullable();
            $table->foreign('id_bentuk_bangunan')->references('id')->on('bentuk_bangunan')->onDelete('cascade');
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
            $table->dropForeign(['id_bentuk_bangunan']);
            $table->dropIndex(['id_bentuk_bangunan']);
            $table->dropColumn('id_bentuk_bangunan');
        });
    }
}
