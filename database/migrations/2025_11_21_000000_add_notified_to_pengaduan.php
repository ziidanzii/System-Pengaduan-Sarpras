<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            // Flag untuk menandai apakah user sudah diberi tahu tentang perubahan status
            // Default false agar pengaduan baru/yang diubah dianggap "belum diberitahu" (unread)
            $table->boolean('notified_to_user')->default(false)->after('tgl_selesai');
        });
    }

    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropColumn('notified_to_user');
        });
    }
};
