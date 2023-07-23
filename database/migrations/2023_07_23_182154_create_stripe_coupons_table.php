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
        Schema::create('stripe_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_id')->unique();
            $table->string('title')->unique();
            $table->float('percent_off')->nullable();
            $table->string('amount_off')->nullable()->comment('A positive integer representing the amount to subtract from an invoice total (required if percent_off is not passed)');
            $table->string('duration')->comment('forever, once, repeating');
            $table->integer('duration_in_months')->nullable()->comment('if duration is repeating');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripe_coupons');
    }
};
