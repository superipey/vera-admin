<?php

namespace App\Http\Controllers;

use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if ($a = auth()->once($credentials)) {
            $token = \Str::random(60);

            auth()->user()->forceFill([
                'api_token' => hash('sha256', $token),
            ])->save();

            return ['token' => $token];
        }
    }

    public function getIdentity(Request $request)
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

            $face = [];
            foreach ($find['FaceMatches'] ?? [] as $row) {
                $nis = $row['Face']['ExternalImageId'];
                $face[] = [
                    'nis' => $nis,
                    'similarity' => $row['Similarity'],
                    'data' => \App\Siswa::find($nis)
                ];
            }

            return $face;
        }
    }
}
