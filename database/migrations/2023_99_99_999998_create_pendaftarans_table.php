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
            $table->enum('semester',['semester 1','semester 2','semester 3','semester 4','semester 5','semester 6','semester 7','semester 8',]);
            $table->string('VA')->unique();
            $table->string('subtotal');
            $table->enum('status_pembayaran',['lunas','belum dibayar']);
            $table->timestamps();
        });

        Schema::table('pendaftaran', function(Blueprint $table){
            $table->foreign('product_id')->on('product')->references('id')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->on('user')->references('id')->onDelete('restrict')->onUpdate('cascade');
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
