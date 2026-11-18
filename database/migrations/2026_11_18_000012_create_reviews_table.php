<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::create('reviews', function (Blueprint $table) {
    $table->id();
    $table->foreignId('booking_id')->unique()->constrained('bookings')->cascadeOnDelete();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('court_id')->constrained('courts')->cascadeOnDelete();
    $table->unsignedTinyInteger('rating');
    $table->text('comment')->nullable();
    $table->timestamps();
});
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            \Illuminate\Support\Facades\DB::statement(
                'ALTER TABLE reviews ADD CONSTRAINT reviews_rating_chk CHECK (rating BETWEEN 1 AND 5)'
            );
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
