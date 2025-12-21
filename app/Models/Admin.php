<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
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
        'last_login',
    ];

    protected $hidden = [
        'password',
    ];
    public function isAdmin(): bool
{
    return in_array($this->role, ['admin', 'super_admin']);
}

public function isSuperAdmin(): bool
{
    return $this->role === 'super_admin';
}

}