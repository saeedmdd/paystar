<?php

namespace App\Services\Uploader;

use Illuminate\Http\Request;

class FileUploader
{
    public function upload(Request $request, string $key, string $addr): ?string
    {
        if (empty($file = $request->file($key))) {
            return null;
        }
        $img = $file->hashName($addr);
        $file->move($addr, $img);

        return asset($img);
    }

}
