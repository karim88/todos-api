<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $data //Data to return
     * @param $err //Error message
     * @param string $msg //Message if any
     * @return \Illuminate\Http\JsonResponse
     */
    function ParsedReturn($data, $err, $msg='') {
        if (!$data) {
            return response()->json([
                'data' => [],
                'message' => $err
            ]);
        }
        return response()->json([
            'data' => $data,
            'message' => $msg ?? ''
        ]);
    }
}
