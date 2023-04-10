<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->string("nomor_invoice", 25)->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pendaftaran_id');
            $table->timestamps();
        });

        Schema::table('invoice', function (Blueprint $table) {
            $table->foreign("user_id")->on("user")->references("id")->onDelete('restrict')->onUpdate("cascade");
            $table->foreign("pendaftaran_id")->on("pendaftaran")->references("id")->onDelete('restrict')->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
