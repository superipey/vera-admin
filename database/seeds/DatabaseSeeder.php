<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        \App\TahunPelajaran::create(
            ['tahun_pelajaran' => '2019/2020', 'status' => 1]
        );

        \App\Biodata::create(
            [
                'nama_lengkap' => 'Ferry Stephanus Suwita',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1994-01-23',
                'agama' => 'Islam',
                'alamat_jalan' => 'Jl. Bojongloa No. 80A',
                'alamat_rt' => '02',
                'alamat_rw' => '05',
                'alamat_desa' => 'Panjunan',
                'alamat_kecamatan' => 'Astana Anyar',
                'alamat_kota' => 'Bandung',
                'alamat_pos' => '42024',
                'telp_mobile' => '08562294222',
                'email' => 'ferryss@smkn4bdg.sch.id'
            ]
        );

        \App\Biodata::create(
            [
                'nama_lengkap' => 'Lukmannul Hakim Firdaus',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1994-01-06',
                'agama' => 'Islam',
                'alamat_jalan' => 'Kp. Pangkalan',
                'alamat_rt' => '05',
                'alamat_rw' => '06',
                'alamat_desa' => 'Tarajusari',
                'alamat_kecamatan' => 'Pangkalan',
                'alamat_kota' => 'Kab. Bandung',
                'alamat_pos' => '41234',
                'telp_mobile' => '08994811234',
                'email' => 'elhakimfirdaus@smkn4bdg.sch.id'
            ]
        );

        \App\Biodata::create(
            [
                'nama_lengkap' => 'Irvan Lutfi Gunawan',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2000-06-17',
                'agama' => 'Islam',
                'alamat_jalan' => 'JL Babakan Ciparay',
                'alamat_rt' => '05',
                'alamat_rw' => '03',
                'alamat_desa' => 'Sukahaji',
                'alamat_kecamatan' => 'Babakan Ciparay',
                'alamat_kota' => 'Bandung',
                'alamat_pos' => '40221',
                'telp_mobile' => '089526608672',
                'email' => 'irvan.devv17@gmail.com'
            ]
        );

        \App\Biodata::create(
            [
                'nama_lengkap' => 'Arif Rachman Hakim',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1998-12-29',
                'agama' => 'Islam',
                'alamat_jalan' => 'Jalan Jaksanaranata no. 36',
                'alamat_rt' => '07',
                'alamat_rw' => '10',
                'alamat_desa' => 'Baleendah',
                'alamat_kecamatan' => 'Baleendah',
                'alamat_kota' => 'Kab. Bandung',
                'alamat_pos' => '40375',
                'telp_mobile' => '082127425764',
                'email' => 'sir.louis.trenet@gmail.com'
            ]
        );

        \App\Guru::create(
            [
                'id_biodata' => 1,
                'nip' => '41277026124',
                'kategori_guru' => 2,
                'status' => 1,
                'username' => 'superipey',
                'password' => bcrypt('superipey')
            ]
        );
        \App\Guru::create(
            [
                'id_biodata' => 2,
                'nip' => '41277026125',
                'kategori_guru' => 2,
                'status' => 1,
                'username' => 'elhakim',
                'password' => bcrypt('elhakim')
            ]
        );

        \App\Kelas::create(
            ['id_tahun_pelajaran' => 1, 'nama_kelas' => 'XII-RPL1', 'id_guru' => 1]
        );

        \App\Kelas::create(
            ['id_tahun_pelajaran' => 1, 'nama_kelas' => 'XII-RPL2', 'id_guru' => 2]
        );

        \App\Siswa::create(
            ['id_biodata' => 3, 'nis' => '14012000', 'nisn' => '990014012000', 'id_tahun_pelajaran' => 1]
        );

        \App\Siswa::create(
            ['id_biodata' => 4, 'nis' => '14012001', 'nisn' => '990014012001', 'id_tahun_pelajaran' => 1]
        );

        \App\DetailKelas::create(
            ['id_kelas' => 1, 'nis' => '14012000']
        );

        \App\DetailKelas::create(
            ['id_kelas' => 2, 'nis' => '14012001']
        );
    }
}
