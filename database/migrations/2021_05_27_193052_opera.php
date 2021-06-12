<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Opera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opera', function (Blueprint $table) {
            $table->id();
            $table->string("titolo", 255);
            $table->string("immagine", 255);
            $table->string("autore", 255);
            $table->string("descrizione", 255);
            $table->unsignedBigInteger("categoria_id");

            $table->foreign("categoria_id")->references("id")->on("categoria");


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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('opera');
    }
}
