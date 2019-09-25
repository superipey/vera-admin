<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Face extends Model
{
    protected $table = 'tbl_face';

    protected $fillable = [
        'nis', 'filename', 'face_id', 'image_id'
    ];
}
