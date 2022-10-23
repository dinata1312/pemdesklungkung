<?php

namespace App\Repositories;

use App\Models\Blob;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ImageOptimizer;

class BlobRepository extends Repository
{

    public function __construct()
    {
        $this->model = new Blob;
    }

    protected function disk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }

    /**
     * uploadFile
     *
     * @param  mixed $object
     * @param  mixed $directory
     * @param  mixed $private
     * @param  mixed $relPath
     * @return void
     */
    public function uploadFile($object, $directory, $private = 0, $relPath=False)
    {
        $originName = pathinfo($object->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = date('YmHis')."_".$object->getClientOriginalName();
        $filePath = $object->storeAs("viewfile/$directory", $fileName, ['disk' => $this->disk()]);
        $fileExt  = strtolower($object->getClientOriginalExtension());
        $auth = Auth::check() ? Auth::user()->id : null;
        $this->model->create([
            "filename" => $originName,
            "directory" => $directory,
            "path" => $filePath,
            "private" => $private,
            "extension" => $fileExt,
            "created_by" => $auth,
        ]);
        // if(file_type($fileExt)=="image"){
        //     ImageOptimizer::optimize($filePath);
        // }
        if($relPath) return $filePath;
        return asset("/storage/$filePath");
    }

    /**
     * delete object from storage
     *
     * @param mixed $object
     * @return string
     */
    public function deleteFile($object)
    {
        $objectPath = "public/" . $object->path;
        Storage::delete($objectPath);
    }
}
