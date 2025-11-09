<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('tipe', 50)->default('Dalam Proses');
            $table->string('color', 20)->default('#3B82F6'); // Warna hex
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('statuses');
    }
};