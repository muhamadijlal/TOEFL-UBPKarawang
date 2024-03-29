<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periode', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('nama_periode', 100);
            $table->date('start_periode');
            $table->date('end_periode');
            $table->date('expired_periode');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('periode', function (Blueprint $table){
            $table->foreign('product_id')->on('product')->references('id')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periode');
    }
}
