<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('banner_path')->nullable()->after('image_path');
            $table->string('banner_link')->nullable()->after('banner_path');
            $table->string('banner_message')->nullable()->after('banner_link');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['banner_path', 'banner_link', 'banner_message']);
        });
    }
};
