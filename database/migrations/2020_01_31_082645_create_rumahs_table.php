<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRumahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rumah', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->integer('status')->default(1);
            $table->text('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('harga');
            $table->double('luas_tanah');
            $table->double('luas_bangunan');
            $table->integer('jumlah_lantai');
            $table->integer('jumlah_kamar_tidur');
            $table->integer('jumlah_kamar_mandi');
            $table->float('daya_listrik');
            $table->string('nomor_telepon');
            $table->text('deskripsi')->nullable();
            $table->integer('dekat_pasar')->nullable();
            $table->integer('dekat_sekolah')->nullable();
            $table->integer('dekat_pusat_perbelanjaan')->nullable();
            $table->integer('dekat_sarana_olahraga')->nullable();
            $table->integer('bebas_banjir')->nullable();
            $table->integer('daerah_sepi')->nullable();
            $table->integer('daerah_rindang')->nullable();
            $table->integer('status_jalan')->nullable();
            $table->integer('garasi')->nullable();
            $table->integer('carport')->nullable();
            $table->integer('keamanan')->nullable();
            $table->integer('petugas_kebersihan')->nullable();
            $table->integer('halaman')->nullable();        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rumah');
    }
}
