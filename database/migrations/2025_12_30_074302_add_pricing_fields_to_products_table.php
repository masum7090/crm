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
        Schema::table('products', function (Blueprint $table) {
            // Introductory pricing (first purchase)
            $table->decimal('intro_price_1y', 10, 2)->nullable()->after('price');
            $table->decimal('intro_price_2y', 10, 2)->nullable()->after('intro_price_1y');
            $table->decimal('intro_price_3y', 10, 2)->nullable()->after('intro_price_2y');
            
            // Regular renewal pricing
            $table->decimal('renewal_price_1y', 10, 2)->nullable()->after('intro_price_3y');
            $table->decimal('renewal_price_2y', 10, 2)->nullable()->after('renewal_price_1y');
            $table->decimal('renewal_price_3y', 10, 2)->nullable()->after('renewal_price_2y');
            
            // Monthly pricing (if offered)
            $table->decimal('monthly_price', 10, 2)->nullable()->after('renewal_price_3y');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'intro_price_1y',
                'intro_price_2y',
                'intro_price_3y',
                'renewal_price_1y',
                'renewal_price_2y',
                'renewal_price_3y',
                'monthly_price'
            ]);
        });
    }
};
