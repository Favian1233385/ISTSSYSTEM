<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('campus_item_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campus_item_id');
            $table->string('title');
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->string('external_url')->nullable();
            $table->string('pdf_url')->nullable();
            $table->string('image_url')->nullable();
            $table->string('image_path')->nullable();
            $table->string('video_url')->nullable();
            $table->string('video_path')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('form_html')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('campus_item_id')->references('id')->on('campus_items')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('campus_item_contents');
    }
};
