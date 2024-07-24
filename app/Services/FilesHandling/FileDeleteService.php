<?php

namespace App\Services\FilesHandling;
use Illuminate\Support\Facades\File;

class FileDeleteService
{
    public function fileDelete($file_path): string
    {
        $file_path = asset($file_path);
        $path = public_path($file_path);
        if (File::exists($path)) {
            File::delete($path);
        }else{
            abort(404, 'file not exist!');
        }
        return 'deleted successfully';
    }
}
