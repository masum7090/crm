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
        Schema::create('domain_extensions', function (Blueprint $table) {
            $table->id();
            $table->string('extension', 20)->unique();
            $table->decimal('register_price', 10, 2);
            $table->decimal('renewal_price', 10, 2);
            $table->decimal('transfer_price', 10, 2)->nullable();
            $table->string('provider')->nullable();  // Namecheap, ResellerClub, Internal      
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_extensions');
    }
};
