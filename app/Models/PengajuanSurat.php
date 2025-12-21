<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_surat';

    protected $fillable = [
        'nomor_pengajuan',
        'jenis_surat_id',
        'nomor_surat',
        'nama_pemohon',
        'email_pemohon',
        'no_hp_pemohon',
        'status',
        'admin_id',
        'catatan_admin',
        'tanggal_diproses',
        'file_surat_cetak',
        'tanggal_cetak',
        'tanggal_notifikasi_warga',
        'tanggal_diambil',
        'admin_serah_terima_id',
    ];

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function adminSerahTerima()
    {
        return $this->belongsTo(Admin::class, 'admin_serah_terima_id');
    }
}

