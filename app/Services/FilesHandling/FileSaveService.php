<?php

namespace App\Services\FilesHandling;

class FileSaveService
{
    public function fileSave ($file, $directory): ?string
    {
        $newDirectory = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path($directory),$newDirectory);
        return $directory.'/'.$newDirectory;
    }
}
