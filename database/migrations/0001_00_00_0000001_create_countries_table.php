<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
             $table->string('name');
            $table->string('shortcut');
            $table->string('icon'); // Path or reference for the country flag icon
            $table->string('phone_number_code');
            $table->string('currency')->nullable();
            $table->string('currency_rate')->nullable()->default('Based on BDT Currency');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
