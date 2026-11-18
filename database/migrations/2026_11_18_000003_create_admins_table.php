<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::create('admins', function (Blueprint $table) {
    $table->id();
    $table->foreignId('super_admin_id')->constrained('super_admins')->restrictOnDelete();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->string('phone', 30)->nullable();
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
