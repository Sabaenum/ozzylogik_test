<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bank_rates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bankId');
            $table->string('code');
            $table->decimal('bid');
            $table->decimal('ask');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_rates');
    }
};
