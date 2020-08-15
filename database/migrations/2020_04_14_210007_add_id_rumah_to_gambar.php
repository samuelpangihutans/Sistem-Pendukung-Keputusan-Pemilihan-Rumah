<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdRumahToGambar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gambar', function (Blueprint $table) {
            $table->index('id_rumah');
            $table->unsignedBigInteger('id_rumah');
            $table->foreign('id_rumah')->references('id')->on('rumah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gambar', function (Blueprint $table) {
            $table->dropForeign(['id_rumah']);
            $table->dropIndex(['id_rumah']);
            $table->dropColumn('id_rumah');
        });
    }
}
