<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Aws\Rekognition\RekognitionClient;
use Aws\S3\S3Client;

class ImagesController extends Controller
{
    public function get(Request $request, $file)
    {
        $filename = basename($file);
        $file_extension = strtolower(substr(strrchr($filename, "."), 1));

        switch ($file_extension) {
            case "gif":
                $ctype = "image/gif";
                break;
            case "png":
                $ctype = "image/png";
                break;
            case "jpeg":
            case "jpg":
                $ctype = "image/jpeg";
                break;
            default:
        }

        header('Content-type: ' . $ctype);
        echo \Storage::disk('s3')->get($file);
    }
}
