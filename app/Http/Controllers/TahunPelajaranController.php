<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Aws\Rekognition\RekognitionClient;
use Aws\S3\S3Client;

class TahunPelajaranController extends Controller
{
    public function index(Request $request)
    {
        $data['result'] = \App\TahunPelajaran::orderBy('created_at')->get();
        return view('tahunpelajaran.list', $data);
    }

    public function create(Request $request)
    {
        return view('tahunpelajaran.form');
    }

    public function edit(Request $request, $nis)
    {
        $data['result'] = \App\TahunPelajaran::find($nis);
        return view('tahunpelajaran.form', $data);
    }

    public function store(Request $request, $nis = 0)
    {
        $rules = [
            'tahun_pelajaran' => 'required',
        ];

        $this->validate($request, $rules);

        $input = $request->all();

        if (!empty($nis)) {
            $tahunpelajaran = \App\TahunPelajaran::find($nis);
            $tahunpelajaran->update($input);
            $tahunpelajaran->biodata->update($input);
            return redirect('tahun-pelajaran')->with('success', 'Data berhasil diubah');
        } else {
            \App\TahunPelajaran::create($input);
            return redirect('tahun-pelajaran')->with('success', 'Data berhasil ditambah');
        }
    }

    public function setAktif(Request $request, $id)
    {
        $tpl = \App\TahunPelajaran::all();
        foreach ($tpl as $row) {
            if ($row->id == $id) $row->status = 1;
            else $row->status = 0;
            $row->save();
        }

        return redirect('tahun-pelajaran')->with('success', 'Tahun Pelajaran Berhasil Diaktifkan');
    }

    public function destroy(Request $request, $nis)
    {
        $data['result'] = \App\TahunPelajaran::find($nis)->delete();
        return redirect('tahun-pelajaran')->with('success', 'Data berhasil dihapus');
    }
}
