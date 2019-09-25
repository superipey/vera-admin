<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunPelajaran extends Model
{
    protected $table = 'tbl_tahun_pelajaran';

    protected $fillable = [
        'id_tahun_pelajaran', 'tahun_pelajaran', 'status'
    ];
}
