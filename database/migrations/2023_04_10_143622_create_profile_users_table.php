<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nim', 15);
            $table->string('no_handphone', 15)->nullable();
            $table->string('semester', 12)->nullable();
            $table->string('program_studi', 25)->nullable();
            $table->timestamps();
        });

        Schema::table('profile', function (Blueprint $table) {
            $table->foreign('user_id')->on('user')->references('id')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_user');
    }
}
