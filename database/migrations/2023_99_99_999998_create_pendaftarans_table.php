<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('virtual_account', 10)->unique();
            $table->float('subtotal');
            $table->boolean('status_pembayaran');
            $table->timestamps();
        });

        Schema::table('pendaftaran', function(Blueprint $table){
            $table->foreign('product_id')->on('product')->references('id')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->on('user')->references('id')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('periode_id')->on('periode')->references('id')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
}
