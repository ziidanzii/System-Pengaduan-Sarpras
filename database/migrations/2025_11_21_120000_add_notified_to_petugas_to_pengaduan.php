<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            // Flag untuk menandai apakah petugas sudah diberitahu tentang pengaduan baru
            // Default false agar pengaduan baru dianggap "belum dibaca" oleh petugas
            $table->boolean('notified_to_petugas')->default(false)->after('notified_to_user');
        });
    }

    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropColumn('notified_to_petugas');
        });
    }
};
