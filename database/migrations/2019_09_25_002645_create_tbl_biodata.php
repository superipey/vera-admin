<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBiodata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_biodata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_lengkap', 100);
            $table->string('jenis_kelamin', 1);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('agama', 50);
            $table->string('alamat_jalan', 150);
            $table->string('alamat_rt', 5);
            $table->string('alamat_rw', 5);
            $table->string('alamat_desa', 100);
            $table->string('alamat_kecamatan', 100);
            $table->string('alamat_kota', 100);
            $table->string('alamat_pos', 10)->nullable();
            $table->string('telp_mobile', 20);
            $table->string('email', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_biodata');
    }
}
