<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait ImageUpload
{
    public  $img = '/images/noimage.png';
    public function ImageUpload($file) // Taking input image as parameter
    {
        $image_name = $file->getClientOriginalName();
        $image_full_name =  time() . $image_name;
        $upload_path = 'images/';
        $image_url = $upload_path . $image_full_name;
        $file->move(public_path() . '/' . $upload_path, $image_full_name);

        return '/' . $image_url;
    }
}
