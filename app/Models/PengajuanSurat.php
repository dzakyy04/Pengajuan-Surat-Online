<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_surat';

    protected $guarded = ['id'];

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function suratTidakMampu()
    {
        return $this->hasOne(SuratTidakMampu::class, 'pengajuan_surat_id');
    }
}
