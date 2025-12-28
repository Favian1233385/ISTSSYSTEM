<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('site_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('total_visits')->default(0);
            $table->timestamps();
        });
        // Insertar registro inicial
        \DB::table('site_stats')->insert([
            'total_visits' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('site_stats');
    }
};
