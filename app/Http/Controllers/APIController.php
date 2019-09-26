<?php

namespace App\Http\Controllers;

use Aws\Rekognition\RekognitionClient;
use Faker\Provider\File;
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
                    'foto' => url('images', \App\Face::where('face_id', $row['Face']['FaceId'])->first()->filename),
                    'data' => \App\Siswa::find($nis)
                ];
            }

            return $face;
        }
    }

    public function getIdentityTelegram(Request $request)
    {
        $token = @$request->token;
        $username = @$request->username;
        $link = @$request->link;
        $link = urldecode($link);

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.telegram.org']);
        $response = $client->request('GET', '/bot841068209:AAHD_e_zn1jv06ZakE5S3ZgaI5H3VyEVG0M/getFile?file_id=' . $link);
        $response = json_decode($response->getBody()->getContents());
        $file_path = $response->result->file_path;

        $response2 = $client->request('GET', '/file/bot841068209:AAHD_e_zn1jv06ZakE5S3ZgaI5H3VyEVG0M/' . $file_path);
        $fileTemp = base_path('tmp/' . \Str::random(10));

        file_put_contents($fileTemp, $response2->getBody()->getContents());

        if (file_exists($fileTemp)) {
            $credentials = new \Aws\Credentials\Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));

            $options = [
                'region' => env('AWS_DEFAULT_REGION'),
                'version' => 'latest',
                'credentials' => $credentials
            ];

            $fp_image = fopen($fileTemp, 'r');
            $image = fread($fp_image, filesize($fileTemp));
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
                    'foto' => url('images', \App\Face::where('face_id', $row['Face']['FaceId'])->first()->filename),
                    'data' => \App\Siswa::find($nis)
                ];
            }

            return $face;
        }
    }
}
