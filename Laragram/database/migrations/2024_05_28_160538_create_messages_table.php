<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('message_sender', 50);
            $table->foreign('message_sender')->references('username')->on('users')->onDelete('cascade');
            $table->string('message_receiver', 50);
            $table->foreign('message_receiver')->references('username')->on('users')->onDelete('cascade');
            $table->text('content');
            $table->string('status', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
