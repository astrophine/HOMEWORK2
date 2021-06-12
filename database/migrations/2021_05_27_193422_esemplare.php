<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Esemplare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('esemplare', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("opera_id");
            $table->string("descrizione", 255);
            $table->timestamps();

            $table->foreign("opera_id")->references("id")->on("opera");
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
        Schema::dropIfExists('esemplare');    }
}
