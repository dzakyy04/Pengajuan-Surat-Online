<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(JenisSurat::class);


        DB::transaction(function () {

            /**
             * Ambil ID jenis surat SKTM
             */
            $jenisSuratId = DB::table('jenis_surat')
                ->where('kode', 'SKTM')
                ->value('id');

            if (!$jenisSuratId) {
                throw new \Exception('Jenis surat SKTM belum ada, jalankan seeder jenis_surat dulu');
            }

            /**
             * =========================
             * DATA 1 — DENGAN 2 ANGGOTA
             * =========================
             */
            $pengajuanId1 = DB::table('pengajuan_surat')->insertGetId([
                'nomor_pengajuan' => 'PGJ-SKTM-001',
                'jenis_surat_id' => $jenisSuratId,
                'nama_pemohon' => 'Rusdi',
                'email_pemohon' => 'rusdi@gmail.com',
                'no_hp_pemohon' => '081234567890',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('surat_tidak_mampu')->insert([
                'pengajuan_surat_id' => $pengajuanId1,
                'nama' => 'Rusdi',
                'nik' => '1607011212780008',
                'tempat_lahir' => 'Banyuasin',
                'tanggal_lahir' => '1978-12-12',
                'jenis_kelamin' => 'Laki-Laki',
                'status_perkawinan' => 'Kawin',
                'agama' => 'Islam',
                'pekerjaan' => 'Buruh Harian Lepas',
                'alamat' => 'Dusun II Desa Sungai Rebo',
                'rt' => '003',
                'rw' => '002',
                'dusun' => 'Dusun II',
                'no_surat_rt' => '12/RT-003/X/2024',
                'tanggal_surat_rt' => '2024-10-01',
                'keperluan' => '<p>Untuk pengajuan bantuan sosial dari pemerintah daerah.</p>',
                'anggota_keluarga' => json_encode([
                    ['nama' => 'Siti', 'nik' => '1607012312850002'],
                    ['nama' => 'Ahmad', 'nik' => '1607011010100003'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            /**
             * =========================
             * DATA 2 — DENGAN 1 ANGGOTA
             * =========================
             */
            $pengajuanId2 = DB::table('pengajuan_surat')->insertGetId([
                'nomor_pengajuan' => 'PGJ-SKTM-002',
                'jenis_surat_id' => $jenisSuratId,
                'nama_pemohon' => 'Slamet',
                'email_pemohon' => 'slamet@gmail.com',
                'no_hp_pemohon' => '081298765432',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('surat_tidak_mampu')->insert([
                'pengajuan_surat_id' => $pengajuanId2,
                'nama' => 'Slamet',
                'nik' => '1607011512800009',
                'tempat_lahir' => 'Banyuasin',
                'tanggal_lahir' => '1980-05-15',
                'jenis_kelamin' => 'Laki-Laki',
                'status_perkawinan' => 'Kawin',
                'agama' => 'Islam',
                'pekerjaan' => 'Petani',
                'alamat' => 'Dusun I Desa Sungai Rebo',
                'rt' => '001',
                'rw' => '001',
                'dusun' => 'Dusun I',
                'no_surat_rt' => '05/RT-001/V/2024',
                'tanggal_surat_rt' => '2024-05-20',
                'keperluan' => '<p>Untuk persyaratan pengajuan BPJS Kesehatan.</p>',
                'anggota_keluarga' => json_encode([
                    ['nama' => 'Aisyah', 'nik' => '1607012312999999'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            /**
             * =========================
             * DATA 3 — TANPA ANGGOTA
             * =========================
             */
            $pengajuanId3 = DB::table('pengajuan_surat')->insertGetId([
                'nomor_pengajuan' => 'PGJ-SKTM-003',
                'jenis_surat_id' => $jenisSuratId,
                'nama_pemohon' => 'Wahyudi',
                'email_pemohon' => 'wahyudi@gmail.com',
                'no_hp_pemohon' => '081377788899',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('surat_tidak_mampu')->insert([
                'pengajuan_surat_id' => $pengajuanId3,
                'nama' => 'Wahyudi',
                'nik' => '1607010512700011',
                'tempat_lahir' => 'Banyuasin',
                'tanggal_lahir' => '1970-07-05',
                'jenis_kelamin' => 'Laki-Laki',
                'status_perkawinan' => 'Belum Kawin',
                'agama' => 'Islam',
                'pekerjaan' => 'Pekerja Lepas',
                'alamat' => 'Dusun III Desa Sungai Rebo',
                'rt' => '004',
                'rw' => '003',
                'dusun' => 'Dusun III',
                'no_surat_rt' => '02/RT-004/II/2024',
                'tanggal_surat_rt' => '2024-02-10',
                'keperluan' => '<p>Untuk pengajuan bantuan sosial.</p>',
                'anggota_keluarga' => null, // 🔥 TANPA ANGGOTA
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        DB::table('admin')->insert([
            'username' => 'admin',
            'nama' => 'Administrator',
            'email' => 'admin@mail.com',
            'no_hp' => '081234567890',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'aktif' => true,
            'last_login' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
