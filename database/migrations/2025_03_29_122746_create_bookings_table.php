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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('rating')->nullable();
            $table->datetime('booking_date');
            $table->string('booking_time');
            $table->enum('status', ['pending', 'confirmed', 'canceled', 'completed', 'refunded'])->default('pending');
            $table->decimal('total_price', 10, 2);
            $table->boolean('home_service')->default(false);
            $table->float('distance')->nullable();
            $table->decimal('shipping_fee', 8, 2)->nullable();
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->enum('cancel_status', ['requested', 'approved', 'rejected'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
