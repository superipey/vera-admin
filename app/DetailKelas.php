<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailKelas extends Model
{
    protected $table = 'tbl_detail_kelas';

    protected $fillable = [
        'id_kelas', 'nis'
    ];

    public function kelas()
    {
        return $this->hasOne('\App\Kelas', 'id', 'id_kelas');
    }
}
