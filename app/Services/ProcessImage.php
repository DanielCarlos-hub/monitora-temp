<?php

namespace App\Services;

use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProcessImage
{

    public function convertImage(?UploadedFile $file, int $width, int $height, string $disk = '', string $actualFile = ''){

        if(is_null($file)){
            return $actualFile; //caminho do arquivo atual no banco de dados ou caminho vazio
        }

        $filename = $file->getClientOriginalName();
        $path = $file->move(storage_path().'\app\public\backup', $filename)->getRealPath();

        switch ($disk) {
            case 'logo':
                Image::make($path)->resize($width, $height)->save(storage_path().'\app\public\site\logo/'.$filename);
                break;

            case 'favicon':
                Image::make($path)->resize($width, $height)->save(storage_path().'\app\public\site\favicon/'.$filename);
                break;

            case 'artigos':
                Image::make($path)->resize($width, $height)->save(storage_path().'\app\public\site\paginas\artigos/'.$filename);

        }

        return $filename;
    }
}
