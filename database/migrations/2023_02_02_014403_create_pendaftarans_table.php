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
            $table->string('nama');
            $table->string('nim');
            $table->string('email');
            $table->string('telepon');
            $table->enum('semester',['semester 1','semester 2','semester 3','semester 4','semester 5','semester 6','semester 7','semester 8',]);
            $table->enum('bahasa',['inggris','jepang']);
            $table->enum('jenis',['test','pelatihan','pelatihan dan test']);
            $table->enum('status_pembayaran',['lunas','belum dibayar']);
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
        Schema::dropIfExists('pendaftaran');
    }
}
