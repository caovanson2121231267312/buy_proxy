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
        Schema::create('call_apis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->string('token')->nullable();
            $table->integer('price_type')->default(0);
            $table->integer('round_price')->default(0);
            $table->integer('price_increase')->default(0);
            $table->integer('content_type')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        Schema::create('proxies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('api_id')->references('id')->on('call_apis')->onDelete('cascade');
            $table->string('proxy_type')->nullable();
            $table->string('proxy_type_name')->nullable();
            $table->string('package_code')->nullable();
            $table->string('package_name')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('expiry_time')->nullable();
            $table->string('use_time_min')->nullable();
            $table->integer('status')->default(1);
            $table->longText('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proxies');
        Schema::dropIfExists('call_apis');
    }
};
