<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTidakMampu extends Model
{
    use HasFactory;
    protected $table = 'surat_tidak_mampu';

    protected $guarded = ['id'];

    protected $casts = [
        'anggota_keluarga' => 'array',
        'tanggal_lahir' => 'date',
        'tanggal_surat_rt' => 'date',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanSurat::class, 'pengajuan_surat_id');
    }
}
