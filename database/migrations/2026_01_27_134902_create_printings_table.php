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
    Schema::create('printings', function (Blueprint $table) {
        $table->id();
        $table->string('queue_number');
        $table->string('file_path');    
        $table->enum('status', ['pending', 'paid', 'printed'])->default('pending'); // * Tambahkan ini
        $table->string('ip_address');   
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('printings');
    }
};
