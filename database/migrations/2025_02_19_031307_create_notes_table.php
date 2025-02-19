<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('desc')->nullable(); // Using 'desc' as you requested, consider renaming to 'description' for best practice
            $table->date('date')->nullable();
            $table->string('status')->nullable(); // e.g., 'pending', 'completed', etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
