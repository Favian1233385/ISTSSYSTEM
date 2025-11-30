<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('academic_programs', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('description');
            $table->date('end_date')->nullable()->after('start_date');
            $table->string('registration_url')->nullable()->after('url');
            $table->boolean('registration_enabled')->default(false)->after('registration_url');
        });
    }

    public function down()
    {
        Schema::table('academic_programs', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'end_date', 'registration_url', 'registration_enabled']);
        });
    }
};
