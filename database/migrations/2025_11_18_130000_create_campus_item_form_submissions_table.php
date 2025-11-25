<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('campus_item_form_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campus_item_content_id');
            $table->string('nombres');
            $table->string('cedula');
            $table->string('carrera');
            $table->string('ciclo');
            $table->string('nivel');
            $table->string('institucion');
            $table->string('pdf_path')->nullable();
            $table->timestamps();
            $table->foreign('campus_item_content_id')->references('id')->on('campus_item_contents')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('campus_item_form_submissions');
    }
};
