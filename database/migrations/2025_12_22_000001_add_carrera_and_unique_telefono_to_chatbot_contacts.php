<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('chatbot_contacts', function (Blueprint $table) {
            // $table->string('carrera', 150)->nullable()->after('telefono'); // Ya existe
            $table->unique('telefono');
        });
    }
    public function down() {
        Schema::table('chatbot_contacts', function (Blueprint $table) {
            $table->dropUnique(['telefono']);
            $table->dropColumn('carrera');
        });
    }
};
