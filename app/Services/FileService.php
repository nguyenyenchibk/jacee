<?php

namespace App\Services;

use App\Services\Service;
use App\Services\Interfaces\FileServiceInterface;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileService extends Service implements FileServiceInterface
{
    public function index(Lesson $lesson)
    {
        $files = Storage::disk('s3')->files('teachers/lessons/'.$lesson->id);

        $data = [];
        foreach($files as $file) {
            $data[] = [
                'name' => basename($file),
                'downloadUrl' => $file,
            ];
        }
        return $data;
    }

    public function create(Lesson $lesson, Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:doc,csv,txt,pdf|max:2048',
        ]);

        $fileName = $request->file->getClientOriginalName();
        $filePath = 'teachers/lessons/'.$lesson->id.'/'.$fileName;

        $path = Storage::disk('s3')->put($filePath, file_get_contents($request->file));
        $path = Storage::disk('s3')->url($path);

        $file = $lesson->files()->create([
            'name' => '/'.'lessons/'.$lesson->id.'/'.$fileName,
            'url' => $path.'/'.'lessons/'.$lesson->id.'/'.$fileName
        ]);

        return back()
            ->with('success','File has been successfully uploaded.');
    }

    public function delete($file)
    {
        Storage::disk('s3')->delete($file);
        return true;
    }
}
