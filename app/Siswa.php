<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'tbl_siswa';

    protected $primaryKey = 'nis';

    protected $with = ['biodata', 'detail_kelas'];

    protected $fillable = [
        'nis', 'id_biodata', 'nisn', 'id_tahun_pelajaran'
    ];

    public function biodata()
    {
        return $this->hasOne('\App\Biodata', 'id', 'id_biodata');
    }

    public function detail_kelas()
    {
        return $this->hasOne('\App\DetailKelas', 'nis', 'nis');
    }
}
