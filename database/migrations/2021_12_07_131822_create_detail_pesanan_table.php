<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('pesanan_id');
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('ukuran_id');

            $table->integer('qty');
            $table->integer('harga');
            $table->integer('diskon')->nullable();
            $table->integer('harga_diskon')->nullable();
            $table->integer('total_harga');
            $table->integer('berat');
            $table->integer('total_berat');

            $table->dateTime('in_at')->nullable();
            $table->dateTime('out_at')->nullable();

            // $table->string('status');

            $table->timestamps();

            $table->foreign('pesanan_id')->references('id')->on('pesanan')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
            $table->foreign('ukuran_id')->references('id')->on('ukuran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pesanan');
    }
}
