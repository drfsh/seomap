<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function sendTrue($data,$message): JsonResponse
    {
        return $this->sendJson(true,$data,$message,200);
    }
    protected function sendError($data,$message): JsonResponse
    {
        return $this->sendJson(false,$data,$message,500);
    }

    private function sendJson($ok,$data,$message,$code): JsonResponse
    {
        return response()->json(['ok'=>$ok,'data'=>$data,'messages'=>$message],$code,['Charset'=>'utf-8'],JSON_UNESCAPED_UNICODE);
    }
}
