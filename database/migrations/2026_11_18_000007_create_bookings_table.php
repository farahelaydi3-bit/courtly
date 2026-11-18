<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('court_id')->constrained('courts')->restrictOnDelete();
    $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
    $table->foreignId('created_by_admin_id')->nullable()->constrained('admins')->nullOnDelete();
    $table->foreignId('subscription_id')->nullable()->constrained('subscriptions')->nullOnDelete();
    $table->enum('booking_type', ['individual', 'group', 'subscription']);
    $table->date('booking_date');
    $table->time('start_time');
    $table->time('end_time');
    $table->unsignedSmallInteger('duration_minutes');
    $table->decimal('total_price', 10, 2);
    $table->decimal('deposit_amount', 10, 2)->default(0);
    $table->enum('booking_status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
    $table->timestamps();
    $table->index(['court_id', 'booking_date', 'start_time', 'end_time'], 'bookings_court_slot_idx');
});
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            \Illuminate\Support\Facades\DB::statement(
                'ALTER TABLE bookings ADD CONSTRAINT bookings_actor_chk CHECK (user_id IS NOT NULL OR created_by_admin_id IS NOT NULL)'
            );
            \Illuminate\Support\Facades\DB::statement(
                'ALTER TABLE bookings ADD CONSTRAINT bookings_time_chk CHECK (end_time > start_time)'
            );
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
