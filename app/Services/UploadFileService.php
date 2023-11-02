<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UploadFileService
{
    public function uploadFile($file, $folder_name)
    {
        $folder_name = $folder_name;

        $file_name = $file->getClientOriginalName();

        $file->storeAs('public/' . $folder_name, $file_name);

        $file_path = '/' . $folder_name . '/' . $file_name;

        return $file_path;
    }
}
