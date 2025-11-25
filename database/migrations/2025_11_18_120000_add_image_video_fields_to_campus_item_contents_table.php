<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('campus_item_contents', function (Blueprint $table) {
            $table->string('image_url')->nullable()->after('pdf_url');
            $table->string('image_path')->nullable()->after('image_url');
            $table->string('video_url')->nullable()->after('image_path');
            $table->string('video_path')->nullable()->after('video_url');
        });
    }
    public function down() {
        Schema::table('campus_item_contents', function (Blueprint $table) {
            $table->dropColumn(['image_url', 'image_path', 'video_url', 'video_path']);
        });
    }
};
