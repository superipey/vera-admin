<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'tbl_kelas';

    protected $fillable = [
        'id_tahun_pelajaran', 'id_guru', 'nama_kelas'
    ];

    public function guru()
    {
        return $this->hasOne('\App\Guru', 'id', 'id_guru');
    }
}
