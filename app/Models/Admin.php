<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;

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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'last_login' => 'datetime',
    ];
}
