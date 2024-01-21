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
        Schema::create('minecraft_users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('state');
            $table->integer('op')->nullable();
            $table->dateTime('last_join')->nullable();
            $table->dateTime('last_leave')->nullable();
            $table->integer('server_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minecraft_users');
    }
};
