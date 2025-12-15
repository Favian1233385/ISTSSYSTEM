<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('chatbot_settings', function (Blueprint $table) {
            $table->id();
            $table->text('fallback_message')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_hours')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('chatbot_settings');
    }
};
