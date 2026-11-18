<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::create('courts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('admin_id')->constrained('admins')->restrictOnDelete();
    $table->foreignId('sport_id')->constrained('sports')->restrictOnDelete();
    $table->string('name');
    $table->string('address');
    $table->string('image')->nullable();
    $table->time('opening_time');
    $table->time('closing_time');
    $table->unsignedSmallInteger('min_booking_minutes');
    $table->decimal('weekday_price', 10, 2);
    $table->decimal('weekend_price', 10, 2);
    $table->decimal('evening_price', 10, 2);
    $table->decimal('deposit_amount', 10, 2)->default(0);
    $table->enum('status', ['pending', 'approved', 'rejected', 'inactive'])->default('pending');
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};
