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

    public function getNextNomorSurat()
    {
        $this->increment('counter_terakhir');

        return str_replace(
            ['[NO]', '[TAHUN]'],
            [str_pad($this->counter_terakhir, 4, '0', STR_PAD_LEFT), $this->tahun_counter],
            $this->format_nomor
        );
    }
}
