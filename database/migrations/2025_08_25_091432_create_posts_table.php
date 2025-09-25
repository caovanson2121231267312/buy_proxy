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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');              // Tiêu đề bài viết
            $table->string('slug')->nullable()->unique();              // Tiêu đề bài viết
            $table->text('description')->nullable();              // Nội dung
            $table->longText('content')->nullable();              // Nội dung
            $table->string('image')->nullable();  // Ảnh minh họa
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Tác giả
            $table->integer('status')->default(0); // Tác giả
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
