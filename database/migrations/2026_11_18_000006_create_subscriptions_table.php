<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::create('subscriptions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
    $table->foreignId('admin_id')->constrained('admins')->restrictOnDelete();
    $table->foreignId('previous_subscription_id')->nullable()->constrained('subscriptions')->nullOnDelete();
    $table->string('package_name');
    $table->decimal('total_hours', 8, 2);
    $table->decimal('carried_over_hours', 8, 2)->default(0);
    $table->decimal('used_hours', 8, 2)->default(0);
    $table->decimal('amount', 10, 2);
    $table->unsignedSmallInteger('duration_days');
    $table->date('start_date');
    $table->dateTime('end_date');
    $table->enum('status', ['pending', 'active', 'expired', 'cancelled'])->default('pending');
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
