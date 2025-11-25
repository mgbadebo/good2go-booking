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
            $table->foreignId('service_type_id')->constrained()->onDelete('restrict');
            $table->foreignId('driver_id')->nullable()->constrained()->onDelete('set null');

            $table->enum('hire_type', ['hourly', 'daily']);
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime')->nullable();
            $table->integer('duration_hours')->nullable();

            $table->string('pickup_location', 255);
            $table->string('dropoff_location', 255)->nullable();
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();

            $table->enum('payment_method', ['bank_transfer', 'paystack']);
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'cancelled', 'refunded'])
                  ->default('pending');
            $table->enum('booking_status', ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'])
                  ->default('pending');

            $table->decimal('total_price', 10, 2);
            $table->char('currency', 3)->default('NGN');

            $table->timestamps();

            $table->index('start_datetime');
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
