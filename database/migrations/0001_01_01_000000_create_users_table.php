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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Data login
            $table->string('username')->unique();
            $table->string('password');

            // Data customer
            $table->string('name');
            $table->text('alamat')->nullable();
            $table->string('no_hp', 20)->nullable();

            // Role user
            $table->enum('role', ['admin', 'customer'])->default('customer');

            // Default Laravel
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};