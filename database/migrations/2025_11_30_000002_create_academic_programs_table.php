<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('academic_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_modality_id')->constrained('academic_modalities')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->string('document')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('academic_programs');
    }
};
