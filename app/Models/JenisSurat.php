<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;
    protected $table = 'jenis_surat';

    protected $guarded = ['id'];

    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSurat::class, 'jenis_surat_id');
    }
}
