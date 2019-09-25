<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $table = 'tbl_biodata';

    protected $fillable = [
        'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat_jalan', 'alamat_rt', 'alamat_rw', 'alamat_desa',
        'alamat_kecamatan', 'alamat_kota', 'alamat_pos', 'telp_mobile', 'email'
    ];

    protected $dates = ['tanggal_lahir'];
}
