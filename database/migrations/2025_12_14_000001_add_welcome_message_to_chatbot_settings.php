<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('chatbot_settings', function (Blueprint $table) {
            $table->text('welcome_message')->nullable()->after('contact_hours');
        });
    }
    public function down() {
        Schema::table('chatbot_settings', function (Blueprint $table) {
            $table->dropColumn('welcome_message');
        });
    }
};
