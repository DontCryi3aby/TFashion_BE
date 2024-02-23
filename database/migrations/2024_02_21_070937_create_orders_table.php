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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->string('fullname', 50);
            $table->string('email', 150);
            $table->string('phone_number', 20);
            $table->string('address', 200);
            $table->string('note')->nullable();
            $table->dateTime('order_date');
            $table->string('status')->default('PENDING');
            $table->float('total_money');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};