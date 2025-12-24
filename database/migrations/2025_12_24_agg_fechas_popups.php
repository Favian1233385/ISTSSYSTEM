<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('popups', function (Blueprint $table) {
            $table->date('fecha_inicio')->nullable()->after('id');
            $table->date('fecha_fin')->nullable()->after('fecha_inicio');
        });
    }
    public function down()
    {
        Schema::table('popups', function (Blueprint $table) {
            $table->dropColumn(['fecha_inicio', 'fecha_fin']);
        });
    }
};
