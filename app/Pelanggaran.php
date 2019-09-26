<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    protected $table = 'tbl_pelanggaran';

    protected $fillable = [
        'nis', 'id_guru', 'jenis_pelanggaran', 'catatan'
    ];

    public function guru()
    {
        return $this->hasOne('\App\Guru', 'id', 'id_guru');
    }

    public function siswa()
    {
        return $this->hasOne('\App\Siswa', 'nis', 'nis');
    }

    public function getJenisPelanggaranLabelAttribute()
    {
        $jenis = $this->attributes['jenis_pelanggaran'];
        if ($jenis == 1) return "PSAS";
        if ($jenis == 2) return "SARA";
        if ($jenis == 3) return "Merokok";
        if ($jenis == 4) return "Membuat Kegaduhan";
        if ($jenis == 5) return "Tidak Menjaga Sopan Santun";
        else return '';
    }
}
