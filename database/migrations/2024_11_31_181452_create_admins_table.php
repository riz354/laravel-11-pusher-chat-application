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
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // id column
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->text('bio')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('picture')->nullable()->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamps(); // created_at and updated_at
            $table->boolean('status')->default(true); // active status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
