<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::create('game_players', function (Blueprint $table) {
    $table->id();
    $table->foreignId('group_game_id')->constrained('group_games')->cascadeOnDelete();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->enum('status', ['joined', 'cancelled', 'attended'])->default('joined');
    $table->dateTime('joined_at')->nullable();
    $table->timestamps();
    $table->unique(['group_game_id', 'user_id']);
});
    }

    public function down(): void
    {
        Schema::dropIfExists('game_players');
    }
};
