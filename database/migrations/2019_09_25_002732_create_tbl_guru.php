<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGuru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_guru', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_biodata');
            $table->string('nip', 30);
            $table->tinyInteger('kategori_guru');
            $table->tinyInteger('status')->default(1);

            $table->string('username', 100)->unique();
            $table->string('password');

            $table->tinyInteger('level')->default(0);

            $table->rememberToken();
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
        Schema::dropIfExists('tbl_guru');
    }
}
