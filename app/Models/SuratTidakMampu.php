<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTidakMampu extends Model
{
    use HasFactory;

    protected $table = 'surat_tidak_mampu';

    protected $fillable = [
        'pengajuan_surat_id',
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'rt',
        'rw',
        'dusun',
        'alamat',
        'no_surat_rt',
        'tanggal_surat_rt',
        'keperluan',
        'anggota_keluarga',
    ];
}