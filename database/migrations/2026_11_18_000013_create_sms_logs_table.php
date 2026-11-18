<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::create('sms_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
    $table->foreignId('admin_id')->nullable()->constrained('admins')->nullOnDelete();
    $table->foreignId('waiting_list_id')->nullable()->constrained('waiting_list')->nullOnDelete();
    $table->string('phone', 30);
    $table->string('message_type');
    $table->text('message');
    $table->enum('status', ['pending', 'sent', 'failed', 'delivered'])->default('pending');
    $table->string('provider_message_id')->nullable();
    $table->dateTime('sent_at')->nullable();
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_logs');
    }
};
