<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticable
{
    use Notifiable;

    public $timestamps = false;
    protected $guard = 'user';
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'id_user',
        'nama',
        'jenis_kelamin',
        'id_unit',
        'password',
        'email',
        'kategori',
        'status',
    ];
}
