<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("autoridades", function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("cargo");
            $table->string("categoria");
            $table->text("biografia")->nullable();
            $table->string("foto_path")->nullable();
            $table->string("pdf_path")->nullable();
            $table->integer("orden")->default(0);
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
        Schema::dropIfExists("autoridades");
    }
};
