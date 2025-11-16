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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable();
            $table->string('company_name')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state_region')->nullable();
            $table->string('postcode')->nullable();
            $table->string('language')->nullable();
            $table->string('status')->default('Active');
            $table->string('client_group')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('billing_contact')->nullable();
            $table->string('currency')->default('USD');
            $table->boolean('general_emails')->default(true);
            $table->boolean('invoice_emails')->default(true);
            $table->boolean('support_emails')->default(true);
            $table->boolean('product_emails')->default(true);
            $table->boolean('domain_emails')->default(true);
            $table->boolean('affiliate_emails')->default(true);
            $table->boolean('late_fees')->default(true);
            $table->boolean('separate_invoices')->default(true);
            $table->boolean('status_update')->default(true);
            $table->boolean('overdue_notices')->default(true);
            $table->boolean('disable_cc_processing')->default(false);
            $table->boolean('allow_single_sign_on')->default(true);
            $table->boolean('tax_exempt')->default(false);
            $table->boolean('marketing_emails_optin')->default(false);
            $table->boolean('is_new_user')->default(true);
            $table->text('admin_notes')->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
