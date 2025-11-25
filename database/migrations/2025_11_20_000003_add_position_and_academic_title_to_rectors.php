<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('rectors', function (Blueprint $table) {
            $table->string('position')->nullable()->after('name');
            $table->string('academic_title')->nullable()->after('position');
        });
    }

    public function down()
    {
        Schema::table('rectors', function (Blueprint $table) {
            $table->dropColumn(['position', 'academic_title']);
        });
    }
};
