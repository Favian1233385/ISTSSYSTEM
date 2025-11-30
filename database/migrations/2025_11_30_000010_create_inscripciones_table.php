<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('cedula')->nullable();
            $table->string('email');
            $table->string('telefono')->nullable();
            $table->string('especialidad')->nullable();
            $table->unsignedBigInteger('modalidad_id');
            $table->unsignedBigInteger('programa_id');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->foreign('modalidad_id')->references('id')->on('academic_modalities')->onDelete('cascade');
            $table->foreign('programa_id')->references('id')->on('academic_programs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};
