<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nama mood, misal "Senang"
            $table->string('emoji')->nullable(); // emoji opsional, misal "😊"
            $table->timestamps();
        });

        // Tambahkan kolom mood_id di tabel tasks
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('mood_id')->nullable()->after('status_id');
            $table->foreign('mood_id')->references('id')->on('moods')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['mood_id']);
            $table->dropColumn('mood_id');
        });
        Schema::dropIfExists('moods');
    }
};
