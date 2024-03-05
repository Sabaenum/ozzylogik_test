<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nbu_rates', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->decimal('rate');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nbu_rates');
    }
};
