<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Abbonamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abbonamento', function (Blueprint $table) {
            $table->unsignedBigInteger("sala_id");
            $table->timestamp('data_inizio');
            $table->timestamp('data_fine')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("sala_id")->references("id")->on("sala");
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('abbonamento');
    }
}
