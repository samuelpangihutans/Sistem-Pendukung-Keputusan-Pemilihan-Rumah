<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdBentukTanahToRumah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rumah', function (Blueprint $table) {
        $table->index('id_bentuk_tanah');
        $table->unsignedBigInteger('id_bentuk_tanah')->nullable();
        $table->foreign('id_bentuk_tanah')->references('id')->on('bentuk_tanah')->onDelete('cascade');

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
            $table->dropForeign(['id_bentuk_tanah']);
            $table->dropIndex(['id_bentuk_tanah']);
            $table->dropColumn('id_bentuk_tanah');
        });
    }
}
