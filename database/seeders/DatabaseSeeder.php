<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users table
        DB::table('users')->insert([
            [
                'nama_pengguna' => 'Admin System',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pengguna' => 'Petugas Utama',
                'username' => 'petugas1',
                'email' => 'petugas1@gmail.com',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pengguna' => 'Pengguna Biasa',
                'username' => 'pengguna1',
                'email' => 'pengguna1@gmail.com',
                'password' => Hash::make('pengguna123'),
                'role' => 'pengguna',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Seed lokasi table: Ruang 1-5, Lab Komputer 1-5, Perpustakaan, Kamar Mandi
        DB::table('lokasi')->insert([
            ['id_lokasi' => 1, 'nama_lokasi' => 'Ruang 1', 'created_at' => now(), 'updated_at' => now()],
            ['id_lokasi' => 2, 'nama_lokasi' => 'Ruang 2', 'created_at' => now(), 'updated_at' => now()],
            ['id_lokasi' => 3, 'nama_lokasi' => 'Ruang 3', 'created_at' => now(), 'updated_at' => now()],
            ['id_lokasi' => 4, 'nama_lokasi' => 'Ruang 4', 'created_at' => now(), 'updated_at' => now()],
            ['id_lokasi' => 5, 'nama_lokasi' => 'Ruang 5', 'created_at' => now(), 'updated_at' => now()],
            ['id_lokasi' => 6, 'nama_lokasi' => 'Lab Komputer 1', 'created_at' => now(), 'updated_at' => now()],
            ['id_lokasi' => 7, 'nama_lokasi' => 'Lab Komputer 2', 'created_at' => now(), 'updated_at' => now()],
            ['id_lokasi' => 8, 'nama_lokasi' => 'Lab Komputer 3', 'created_at' => now(), 'updated_at' => now()],
            ['id_lokasi' => 9, 'nama_lokasi' => 'Lab Komputer 4', 'created_at' => now(), 'updated_at' => now()],
            ['id_lokasi' => 10, 'nama_lokasi' => 'Lab Komputer 5', 'created_at' => now(), 'updated_at' => now()],
            ['id_lokasi' => 11, 'nama_lokasi' => 'Perpustakaan', 'created_at' => now(), 'updated_at' => now()],
            ['id_lokasi' => 12, 'nama_lokasi' => 'Kamar Mandi', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed items table: classroom items, lab items, library items, bathroom items
        DB::table('items')->insert([
            // Classroom items (1-5)
            ['id_item' => 1, 'nama_item' => 'Meja Kelas', 'lokasi' => 'Ruang', 'deskripsi' => 'Meja untuk ruang kelas', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 2, 'nama_item' => 'Kursi Kelas', 'lokasi' => 'Ruang', 'deskripsi' => 'Kursi untuk ruang kelas', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 3, 'nama_item' => 'Papan Tulis', 'lokasi' => 'Ruang', 'deskripsi' => 'Papan tulis untuk pengajaran', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 4, 'nama_item' => 'AC Split Kelas', 'lokasi' => 'Ruang', 'deskripsi' => 'AC untuk kenyamanan ruangan', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 5, 'nama_item' => 'Lampu Kelas', 'lokasi' => 'Ruang', 'deskripsi' => 'Lampu penerangan kelas', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            // Lab items (6-10)
            ['id_item' => 6, 'nama_item' => 'Komputer PC', 'lokasi' => 'Lab Komputer', 'deskripsi' => 'Komputer untuk praktik', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 7, 'nama_item' => 'Meja Lab', 'lokasi' => 'Lab Komputer', 'deskripsi' => 'Meja khusus untuk lab', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 8, 'nama_item' => 'Kursi Lab', 'lokasi' => 'Lab Komputer', 'deskripsi' => 'Kursi ergonomis lab', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 9, 'nama_item' => 'Proyektor Lab', 'lokasi' => 'Lab Komputer', 'deskripsi' => 'Proyektor untuk demonstrasi', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 10, 'nama_item' => 'UPS Lab', 'lokasi' => 'Lab Komputer', 'deskripsi' => 'UPS untuk komputer lab', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            // Perpustakaan items (11-14)
            ['id_item' => 11, 'nama_item' => 'Rak Buku', 'lokasi' => 'Perpustakaan', 'deskripsi' => 'Rak penyimpanan buku', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 12, 'nama_item' => 'Meja Baca', 'lokasi' => 'Perpustakaan', 'deskripsi' => 'Meja untuk membaca', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 13, 'nama_item' => 'Kursi Perpustakaan', 'lokasi' => 'Perpustakaan', 'deskripsi' => 'Kursi nyaman untuk membaca', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 14, 'nama_item' => 'AC Perpustakaan', 'lokasi' => 'Perpustakaan', 'deskripsi' => 'AC untuk perpustakaan', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            // Kamar mandi items (15-18)
            ['id_item' => 15, 'nama_item' => 'Keran', 'lokasi' => 'Kamar Mandi', 'deskripsi' => 'Keran air', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 16, 'nama_item' => 'Pintu', 'lokasi' => 'Kamar Mandi', 'deskripsi' => 'Pintu toilet', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 17, 'nama_item' => 'Cermin', 'lokasi' => 'Kamar Mandi', 'deskripsi' => 'Cermin dinding', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_item' => 18, 'nama_item' => 'Lampu Kamar Mandi', 'lokasi' => 'Kamar Mandi', 'deskripsi' => 'Lampu untuk kamar mandi', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed petugas table
        DB::table('petugas')->insert([
            [
                'nama' => 'Budi Santoso',
                'gender' => 'L',
                'telp' => '081234567890',
                'id_user' => 2, // Sesuai dengan user petugas1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Rahayu',
                'gender' => 'P',
                'telp' => '081298765432',
                'id_user' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Seed list_lokasi table (menghubungkan items dengan lokasi)
        $list = [];
        // Ruang 1-5 each have items 1-5
        for ($r = 1; $r <= 5; $r++) {
            for ($it = 1; $it <= 5; $it++) {
                $list[] = ['id_lokasi' => $r, 'id_item' => $it];
            }
        }
        // Lab Komputer 1-5 each have items 6-10
        for ($r = 6; $r <= 10; $r++) {
            for ($it = 6; $it <= 10; $it++) {
                $list[] = ['id_lokasi' => $r, 'id_item' => $it];
            }
        }
        // Perpustakaan -> items 11-14
        for ($it = 11; $it <= 14; $it++) {
            $list[] = ['id_lokasi' => 11, 'id_item' => $it];
        }
        // Kamar Mandi -> items 15-18
        for ($it = 15; $it <= 18; $it++) {
            $list[] = ['id_lokasi' => 12, 'id_item' => $it];
        }
        DB::table('list_lokasi')->insert($list);

        // Seed pengaduan table: create 3 sample complaints
        DB::table('pengaduan')->insert([
            [
                'nama_pengaduan' => 'Kursi Rusak di Ruang 1',
                'deskripsi' => 'Kursi di Ruang 1 patah pada sandaran',
                'lokasi' => 'Ruang 1',
                'foto' => null,
                'status' => 'Selesai',
                'id_user' => 3, // Pengguna biasa
                'id_petugas' => 1, // Budi Santoso
                'id_item' => 2, // Kursi Kelas
                'tgl_pengajuan' => '2024-01-15',
                'tgl_selesai' => '2024-01-17',
                'saran_petugas' => 'Ganti kaki kursi dan perkuat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pengaduan' => 'Komputer Lab Bermasalah',
                'deskripsi' => 'Komputer di Lab Komputer 2 sering restart sendiri',
                'lokasi' => 'Lab Komputer 2',
                'foto' => null,
                'status' => 'Diproses',
                'id_user' => 3,
                'id_petugas' => 1,
                'id_item' => 6, // Komputer PC
                'tgl_pengajuan' => '2024-02-10',
                'tgl_selesai' => null,
                'saran_petugas' => 'Sedang diagnosa hardware',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pengaduan' => 'Keran Bocor di Kamar Mandi',
                'deskripsi' => 'Air mengalir terus setelah keran ditutup',
                'lokasi' => 'Kamar Mandi',
                'foto' => null,
                'status' => 'Diajukan',
                'id_user' => 3,
                'id_petugas' => null,
                'id_item' => 15, // Keran
                'tgl_pengajuan' => '2024-03-01',
                'tgl_selesai' => null,
                'saran_petugas' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Seed temporary_item table (jika diperlukan)
        DB::table('temporary_item')->insert([
            [
                'id_item' => null,
                'nama_barang_baru' => 'Whiteboard Magnetik',
                'lokasi_barang_baru' => 'Gedung A - Lantai 2',
            ],
            [
                'id_item' => 1,
                'nama_barang_baru' => 'Kursi Plastik',
                'lokasi_barang_baru' => 'Laboratorium Komputer',
            ]
        ]);
    }
}
