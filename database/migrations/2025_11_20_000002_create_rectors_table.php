<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('rectors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image_path')->nullable();
            $table->longText('message')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rectors');
    }
};
