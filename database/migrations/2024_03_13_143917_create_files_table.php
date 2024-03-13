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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('size');
            $table->string('type_file');
            $table->enum('status', ['show', 'hidden', 'deleted', 'restringed']);
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('folder_id')->nullable()->constrained('folders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
