<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Ubah kolom role menjadi ENUM
            $table->enum('role', ['admin', 'petugas', 'pengguna'])
                  ->default('pengguna')
                  ->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan ke string jika rollback
            $table->string('role')->change();
        });
    }
};
