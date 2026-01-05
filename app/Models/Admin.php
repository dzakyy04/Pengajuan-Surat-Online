<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin';

    protected $fillable = [
        'username',
        'nama',
        'email',
        'no_hp',
        'password',
        'role',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    // helper
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isKades()
    {
        return $this->role === 'kades';
    }
}

