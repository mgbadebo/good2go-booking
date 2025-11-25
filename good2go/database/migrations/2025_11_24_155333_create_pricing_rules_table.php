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
        Schema::create('pricing_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_type_id')->constrained()->onDelete('cascade');
            $table->enum('hire_type', ['hourly', 'daily']);
            $table->char('currency', 3)->default('NGN');
            $table->decimal('base_rate', 10, 2);
            $table->integer('min_hours')->nullable();     // for hourly
            $table->integer('daily_hours')->nullable();   // for daily
            $table->enum('night_surcharge_type', ['none', 'percent', 'flat'])->default('none');
            $table->decimal('night_surcharge_value', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_rules');
    }
};
