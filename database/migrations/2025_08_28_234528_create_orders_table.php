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
            $table->dateTime('end_date')->nullable();
            $table->longText('payload')->nullable();

            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 12, 0);
            $table->decimal('total_price', 12, 0);
            $table->string('auth_type')->default('ip'); // ip | userpass
            $table->string('ip_address')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->boolean('auto_renew')->default(false);
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('proxy_id')->references('id')->on('proxies')->onDelete('cascade');
            $table->timestamps();
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
