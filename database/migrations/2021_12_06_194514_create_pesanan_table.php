<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();

            $table->string('kode')->unique();
            $table->unsignedBigInteger('user_id');
            $table->integer('total_qty');
            $table->integer('total');
            $table->integer('grand_total');
            $table->text('catatan')->nullable();
            $table->string('status');

            // $table->unsignedBigInteger('approved_by')->nullable();
            // $table->unsignedBigInteger('cancelled_by')->nullable();
            // $table->dateTime('aprroved_at')->nullable();
            // $table->dateTime('cancel_at')->nullable();
            
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->dateTime('canceled_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
