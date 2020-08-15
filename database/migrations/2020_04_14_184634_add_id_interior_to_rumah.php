<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdInteriorToRumah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rumah', function (Blueprint $table) {
            $table->index('id_interior_rumah');
            $table->unsignedBigInteger('id_interior_rumah')->nullable();
            $table->foreign('id_interior_rumah')->references('id')->on('interior_rumah')->onDelete('cascade');
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
            $table->dropForeign(['id_interior_rumah']);
            $table->dropIndex(['id_interior_rumah']);
            $table->dropColumn('id_interior_rumah');
        });
    }
}
