<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::create('waiting_list', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('court_id')->constrained('courts')->cascadeOnDelete();
    $table->date('booking_date');
    $table->time('start_time');
    $table->time('end_time');
    $table->enum('status', ['waiting', 'offered', 'accepted', 'expired', 'cancelled'])->default('waiting');
    $table->dateTime('notified_at')->nullable();
    $table->dateTime('offer_expires_at')->nullable();
    $table->timestamps();
    $table->index(['court_id', 'booking_date', 'start_time', 'end_time', 'status'], 'waitlist_slot_status_idx');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('waiting_list');
    }
};
