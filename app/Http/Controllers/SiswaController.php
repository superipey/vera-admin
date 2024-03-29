<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Aws\Rekognition\RekognitionClient;
use Aws\S3\S3Client;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $data['result'] = \App\Siswa::orderBy('created_at')->get();
        return view('siswa.list', $data);
    }

    public function create(Request $request)
    {
        return view('siswa.form');
    }

    public function edit(Request $request, $nis)
    {
        $data['result'] = \App\Siswa::find($nis);
        return view('siswa.form', $data);
    }

    public function store(Request $request, $nis = 0)
    {
        $rules = [
            'nisn' => 'required',
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
            'id_kelas' => 'required'
        ];
        if (empty($nis)) $rules['nis'] = 'required|unique:tbl_siswa';

        $this->validate($request, $rules);

        $input = $request->all();

        if (!empty($nis)) $input['nis'] = $nis;
        \App\DetailKelas::where('nis', $input['nis'])->delete();
        \App\DetailKelas::create($input);

        if (!empty($nis)) {
            $siswa = \App\Siswa::find($nis);
            $siswa->update($input);
            $siswa->biodata->update($input);
            return redirect('siswa')->with('success', 'Data berhasil diubah');
        } else {
            $biodata = \App\Biodata::create($input);
            $input['id_biodata'] = $biodata->id;
            $input['id_tahun_pelajaran'] = \App\TahunPelajaran::where('status', 1)->first()->id;
            \App\Siswa::create($input);

            return redirect('siswa')->with('success', 'Data berhasil ditambah');
        }
    }

    public function destroy(Request $request, $nis)
    {
        $data['result'] = \App\Siswa::find($nis)->delete();
        return redirect('siswa')->with('success', 'Data berhasil dihapus');
    }

    public function getFoto(Request $request, $id)
    {
        $data['result'] = $siswa = \App\Siswa::find($id);
        $credentials = new \Aws\Credentials\Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));

        $options = [
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'credentials' => $credentials
        ];

        $rekognition = new RekognitionClient($options);
        $listFaces = $rekognition->listFaces(['CollectionId' => 'murid']);
//        dd($listFaces['Faces']);

//        $rekognition->deleteFaces(['CollectionId' => 'murid', 'FaceIds' => ['38e39843-99ad-4e6e-80ff-da6f9cb67021']]);

        $listFiles = [];

        $allFiles = \Storage::disk('s3')->allFiles();
        foreach ($allFiles as $row) {
            if (\Str::contains($row, $siswa->nis)) $listFiles[] = $row;
        }

        $data['files'] = $listFiles;

        return view('siswa.foto', $data);
    }

    public function storeFoto(Request $request)
    {
        $nis = @$request->nis;
        $file = $request->file('file');

        if ($file) {
            $filename = $nis . '_' . \Str::random(5) . "." . $file->getClientOriginalExtension();
            \Storage::disk('s3')->putFileAs('', $file, $filename);

            $credentials = new \Aws\Credentials\Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));
            $options = [
                'region' => env('AWS_DEFAULT_REGION'),
                'version' => 'latest',
                'credentials' => $credentials
            ];

            $rekognition = new RekognitionClient($options);
            $result = $rekognition->indexFaces([
                'CollectionId' => 'murid',
                'ExternalImageId' => $nis,
                'Image' => [
                    'S3Object' => [
                        'Bucket' => env('AWS_BUCKET'),
                        'Name' => $filename,
                    ]
                ],
                'MaxFaces' => 1,
                'QualityFilter' => 'AUTO'
            ]);

            if (empty($result['FaceRecords'])) {
                \Storage::disk('s3')->delete($filename);
                return redirect('siswa/foto/' . $nis)->with('error', 'Face not recognized!');
            }

            $res = $result['FaceRecords'][0]['Face'];

            $face = [
                'nis' => $nis,
                'filename' => $filename,
                'face_id' => $res['FaceId'],
                'image_id' => $res['ImageId'],
            ];
            \App\Face::create($face);
        }

        return redirect('siswa/foto/' . $nis);
    }

    public function destroyFoto(Request $request, $nis, $foto)
    {
        \Storage::disk('s3')->delete($foto);

        $credentials = new \Aws\Credentials\Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));

        $options = [
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'credentials' => $credentials
        ];

        $face = \App\Face::where('filename', $foto)->first();
        if (empty($face)) return redirect('siswa/foto/' . $nis);

        $rekognition = new RekognitionClient($options);
        $rekognition->deleteFaces(['CollectionId' => 'murid', 'FaceIds' => [$face->face_id]]);

        $face->delete();

        return redirect('siswa/foto/' . $nis);
    }

    public function search(Request $request)
    {
        $file = $request->file('file');

        if ($file) {
            $credentials = new \Aws\Credentials\Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));

            $options = [
                'region' => env('AWS_DEFAULT_REGION'),
                'version' => 'latest',
                'credentials' => $credentials
            ];

            $photo = $file->getRealPath();
            $fp_image = fopen($photo, 'r');
            $image = fread($fp_image, filesize($photo));
            fclose($fp_image);

            $rekognition = new RekognitionClient($options);
            $find = $rekognition->searchFacesByImage([
                'CollectionId' => 'murid',
                'Image' => [
                    'Bytes' => $image
                ]
            ]);
            dd($find);
        }
    }
}
