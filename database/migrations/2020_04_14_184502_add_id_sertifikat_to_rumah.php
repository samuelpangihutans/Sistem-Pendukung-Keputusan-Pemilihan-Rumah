<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSertifikatToRumah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rumah', function (Blueprint $table) {
            $table->index('id_sertifikat');
            $table->unsignedBigInteger('id_sertifikat');
            $table->foreign('id_sertifikat')->references('id')->on('sertifikat')->onDelete('cascade');
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
            $table->dropForeign(['id_sertifikat']);
            $table->dropIndex(['id_sertifikat']);
            $table->dropColumn('id_sertifikat');
        });
    }
}
