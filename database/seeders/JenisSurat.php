<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisSurat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisSurat = [
            [
                'kode' => 'SKTM',
                'nama' => 'Surat Keterangan Tidak Mampu',
                'format_nomor' => '440/[NO]/SKTM/SR/[TAHUN]',
                'counter_terakhir' => 0,
                'tahun_counter' => date('Y'),
                'template_path' => 'null',
                'aktif' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode' => 'SKD',
                'nama' => 'Surat Keterangan Domisili',
                'format_nomor' => '440/[NO]/SKD/SR/[TAHUN]',
                'counter_terakhir' => 0,
                'tahun_counter' => date('Y'),
                'template_path' => 'null',
                'aktif' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode' => 'SKU',
                'nama' => 'Surat Keterangan Usaha',
                'format_nomor' => '440/[NO]/SKU/SR/[TAHUN]',
                'counter_terakhir' => 0,
                'tahun_counter' => date('Y'),
                'template_path' => 'null',
                'aktif' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode' => 'SKP',
                'nama' => 'Surat Keterangan Penghasilan',
                'format_nomor' => '440/[NO]/SKP/SR/[TAHUN]',
                'counter_terakhir' => 0,
                'tahun_counter' => date('Y'),
                'template_path' => 'null',
                'aktif' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode' => 'SKMT',
                'nama' => 'Surat Keterangan Kematian',
                'format_nomor' => '440/[NO]/SKMT/SR/[TAHUN]',
                'counter_terakhir' => 0,
                'tahun_counter' => date('Y'),
                'template_path' => 'null',
                'aktif' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('jenis_surat')->insert($jenisSurat);
    }
}
