<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pesanan_id');
            $table->string('nama');
            $table->unsignedBigInteger('provinsi_id');
            $table->unsignedBigInteger('kota_id');
            $table->unsignedBigInteger('kecamatan_id')->nullable();
            $table->text('detail_alamat');
            $table->string('phone');
            $table->string('kode_pos');
            $table->string('kurir');
            $table->string('servis');
            $table->string('etd');
            $table->integer('total_berat');
            $table->integer('biaya');
            $table->string('no_resi')->nullable();


            $table->foreign('pesanan_id')->references('id')->on('pesanan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('provinsi_id')->references('id')->on('provinsi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kota_id')->references('id')->on('kota')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('kecamatan_id')->references('id')->on('kecamatan')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('pengiriman');
    }
}
