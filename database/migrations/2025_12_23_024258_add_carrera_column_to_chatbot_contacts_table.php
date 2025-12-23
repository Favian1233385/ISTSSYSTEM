<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chatbot_contacts', function (Blueprint $table) {
            $table->string('carrera', 150)->nullable()->after('telefono');
        });
    }

    public function down()
    {
        Schema::table('chatbot_contacts', function (Blueprint $table) {
            $table->dropColumn('carrera');
        });
    }
};
