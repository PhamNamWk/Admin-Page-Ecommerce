<?php

namespace App\Controllers;

use Exception;

class Controller
{
    public function uploadFile(array $file)
    {
        $fileTmpPath = $file['tmp_name'];
        $fileName = time() . '-' . $file['name'];
        $fullPath = 'storage/uploads/' . $fileName;
        if (move_uploaded_file($fileTmpPath, $fullPath)) {
            return $fullPath;
        } else {
            $fullPath = null;
        }
    }
}
