<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::create('group_games', function (Blueprint $table) {
    $table->id();
    $table->foreignId('admin_id')->constrained('admins')->restrictOnDelete();
    $table->foreignId('booking_id')->unique()->constrained('bookings')->cascadeOnDelete();
    $table->string('title');
    $table->text('description')->nullable();
    $table->unsignedSmallInteger('max_players');
    $table->enum('status', ['open', 'full', 'cancelled', 'completed'])->default('open');
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('group_games');
    }
};
