<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('timeline_events', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->default(0)->index();
            $table->boolean('is_public')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('timeline_events');
    }
};
