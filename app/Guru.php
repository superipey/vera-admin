<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_guru';

    protected $fillable = [
        'id_tahun_pelajaran', 'id_biodata', 'nip', 'kategori_guru', 'status',
        'username', 'password', 'level'
    ];

    public function biodata()
    {
        return $this->hasOne('\App\Biodata', 'id', 'id_biodata');
    }
}
