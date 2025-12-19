<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['banner_path', 'banner_message', 'banner_link']);
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('banner_path')->nullable();
            $table->string('banner_link')->nullable();
            $table->string('banner_message')->nullable();
        });
    }
};
