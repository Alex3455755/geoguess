<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->decimal('lat', 10, 6);
            $table->decimal('lng', 10, 6);
            $table->string('country');
            $table->string('country_code', 2);
            $table->integer('population')->default(0);
            $table->boolean('is_capital')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
