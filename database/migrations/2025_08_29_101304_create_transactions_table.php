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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->enum('type', ['deposit', 'withdraw']); // nạp hoặc rút
            $table->decimal('amount', 12, 0); // số tiền
            $table->string('method')->nullable(); // ví dụ: momo, bank, paypal
            $table->string('status')->default('pending'); // pending | success | failed
            $table->text('note')->nullable(); // ghi chú
            $table->longText('payload')->nullable(); // ghi chú
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
