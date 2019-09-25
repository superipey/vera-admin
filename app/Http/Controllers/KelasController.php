<?php

namespace App\Http\Controllers;

use App\TahunPelajaran;
use Illuminate\Http\Request;

use Aws\Rekognition\RekognitionClient;
use Aws\S3\S3Client;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $data['result'] = \App\Kelas::orderBy('created_at')->get();
        return view('kelas.list', $data);
    }

    public function create(Request $request)
    {
        $id_guru = \App\Kelas::all()->pluck('id_guru');
        $data['waliKelas'] = \App\Guru::whereNotIn('id', $id_guru)->get();

        return view('kelas.form', $data);
    }

    public function edit(Request $request, $id)
    {
        $data['result'] = \App\Kelas::find($id);

        $id_guru = \App\Kelas::where('id', '<>', $id)->pluck('id_guru');
        $data['waliKelas'] = \App\Guru::whereNotIn('id', $id_guru)->get();

        return view('kelas.form', $data);
    }

    public function store(Request $request, $id = 0)
    {
        $rules = [
            'nama_kelas' => 'required',
            'id_guru' => 'required|exists:tbl_guru,id',
        ];

        $this->validate($request, $rules);

        $input = $request->all();

        if (!empty($id)) {
            $kelas = \App\Kelas::find($id);
            $kelas->update($input);
            return redirect('kelas')->with('success', 'Data berhasil diubah');
        } else {
            $input['id_tahun_pelajaran'] = \App\TahunPelajaran::where('status', 1)->first()->id;
            \App\Kelas::create($input);
            return redirect('kelas')->with('success', 'Data berhasil ditambah');
        }
    }

    public function destroy(Request $request, $id)
    {
        $data['result'] = \App\Kelas::find($id)->delete();
        return redirect('kelas')->with('success', 'Data berhasil dihapus');
    }
}