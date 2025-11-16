<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('member_code')->unique();
            $table->string('password');
            $table->string('pincode', 10);
            $table->string('email')->unique();
            $table->string('mobile', 15)->unique();
            $table->decimal('balance', 52, 3)->default(0.0);
            $table->enum('status', ['active', 'banned'])->default('active');
            $table->string('create_by')->nullable();
            $table->string('last_ip')->nullable();
            $table->string('last_login')->nullable();
            $table->string('last_login_count')->nullable();
            $table->enum('otp_type', ['phone', 'email'])->default('phone');
            $table->boolean('is_2fa_enabled')->default(true);
            $table->text('google2fa_secret')->nullable();
            $table->boolean('google2fa_enabled')->default(false);
            $table->text('recovery_codes')->nullable();
            $table->string('image')->nullable();
            $table->rememberToken();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
