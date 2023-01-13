<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function sendTrue($data,$message): JsonResponse
    {
        return $this->sendJson(true,$data,$message,200);
    }
    protected function sendError($data,$message): JsonResponse
    {
        return $this->sendJson(false,$data,$message,200);
    }

    private function sendJson($ok,$data,$message,$code): JsonResponse
    {
        return response()->json(['ok'=>$ok,'data'=>$data,'messages'=>$message],$code,['Charset'=>'utf-8'],JSON_UNESCAPED_UNICODE);
    }

    public function upload($file, $folder = null,$more=false)
    {
        if ($file != null && $file->isValid()) {
            $type = $file->extension();
            if ($type==null)
                $type = 'file';
            $size = $file->getSize();
            $fileName = time() . '_' . auth()->id() . '_' . $file->getClientOriginalName();
            if ($folder != null)
                $path = "/upload/" . $folder . '/' . $type . "/";
            else
                $path = "/upload/" . $type . "/";

            $file->move('.' . $path, $fileName);
            if (!$more)
                return $path . $fileName;
            else
            {
                $imageType = ['png','jpg','jpeg','gif'];
                if (in_array($type,$imageType)){
                    $tempImage = "/upload/temp/".$fileName;
                    if (!file_exists("./upload/temp/")){
                        File::makeDirectory("./upload/temp/");
                    }
                    $Image = new Image();
                    $Image->compressImage('.'.$path . $fileName,'.'.$tempImage,0.00001);
                    list($width,$height) = getimagesize('.'.$tempImage);
                    return [
                        'url'=>$path . $fileName,
                        'type'=>$type,
                        'name'=>$fileName,
                        'size'=>$size,

                        'temp'=>$tempImage,
                        'width'=>$width,
                        'height'=>$height
                    ];
                }else
                    return [
                        'url'=>$path . $fileName,
                        'type'=>$type,
                        'name'=>$fileName,
                        'size'=>$size
                    ];
            }
        }
        return false;
    }

}
