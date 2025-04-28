<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function stream($path)
    {
        $filePath = 'public/' . $path;
        if (!Storage::exists($filePath)) {
            \Log::error('File not found: ' . $filePath);
            abort(404, 'File not found');
        }

        $file = Storage::get($filePath);
        $name = basename($path);

        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $name . '"')
            ->header('Content-Length', Storage::size($filePath));
    }
}