<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DownloadFileController extends Controller
{
    public function download(Request $request, $fileUuid)
    {
        $file = Media::findByUuid($fileUuid);
        if(!$file)
        {
            abort('File not found.');
        }
        return response()->download($file->getPath(), $file->file_name);
    }
}
