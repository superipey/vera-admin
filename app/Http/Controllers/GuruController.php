<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Aws\Rekognition\RekognitionClient;
use Aws\S3\S3Client;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $data['result'] = \App\Guru::orderBy('created_at')->get();
        return view('guru.list', $data);
    }

    public function create(Request $request)
    {
        return view('guru.form');
    }

    public function edit(Request $request, $nis)
    {
        $data['result'] = \App\Guru::find($nis);
        return view('guru.form', $data);
    }

    public function store(Request $request, $id = 0)
    {
        $rules = [
            'nip' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|dateFormat:Y-m-d',
            'agama' => 'required',
            'alamat_jalan' => 'required',
            'alamat_rt' => 'required',
            'alamat_rw' => 'required',
            'alamat_desa' => 'required',
            'alamat_kecamatan' => 'required',
            'alamat_kota' => 'required',
            'alamat_pos' => 'required',
            'telp_mobile' => 'required',
            'email' => 'required|email',
            'kategori_guru' => 'required'
        ];

        if (empty($id)) {
            $rules['username'] = 'required|unique:tbl_guru';
            $rules['password'] = 'required';
            $rules['repassword'] = 'required|same:password';
            $rules['level'] = 'nullable';
        }

        $this->validate($request, $rules);

        $input = $request->all();

        if (!empty($id)) {
            $guru = \App\Guru::find($id);
            $guru->update($input);
            $guru->biodata->update($input);
            return redirect('guru')->with('success', 'Data berhasil diubah');
        } else {
            $biodata = \App\Biodata::create($input);
            $input['id_biodata'] = $biodata->id;
            \App\Guru::create($input);

            return redirect('guru')->with('success', 'Data berhasil ditambah');
        }
    }

    public function destroy(Request $request, $nis)
    {
        $data['result'] = \App\Guru::find($nis)->delete();
        return redirect('guru')->with('success', 'Data berhasil dihapus');
    }
}