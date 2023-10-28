<?php
namespace App\Services;
use Illuminate\Support\Facades\Storage;

class FileService{

    public function uploadbase64Image($base64File){

        $extension = explode('/', explode(':', substr($base64File, 0, strpos($base64File, ';')))[1])[1];

        $fileData = base64_decode(preg_replace('/data:image\/\w+;base64,/', '', $base64File));

        $fileName = 'images/file_' . time() . '.' . $extension;

        Storage::disk('public')->put($fileName, $fileData);
        
        return $fileName;

    }

    public function destroyFileByName($file_name){
        
        // return Storage::delete($file_name);
        unlink(storage_path('app/public/'.$file_name));


    }

}

?>