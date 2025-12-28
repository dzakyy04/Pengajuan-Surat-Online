<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPenghasilan extends Model
{
    use HasFactory;
    protected $table = 'surat_penghasilan';
    protected $guarded = ['id'];
}
