<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('social_links', function (Blueprint $table) {
            $table->boolean('active')->default(true)->after('url');
            $table->string('icon_svg', 2048)->nullable()->after('active');
            $table->string('bg_color', 128)->nullable()->after('icon_svg');
        });
    }

    public function down(): void
    {
        Schema::table('social_links', function (Blueprint $table) {
            $table->dropColumn(['active', 'icon_svg', 'bg_color']);
        });
    }
};
