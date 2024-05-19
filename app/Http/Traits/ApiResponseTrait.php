<?php
namespace app\Http\Traits;
trait ApiResponseTrait
{
    public function apiResponse($data=null,$message=null,$status=null){
        $array= [
            'data'   => $data,
            'message'=> $message,
            'status' => $status,
        ];
        return response()->json($array,$status);
    }
}
?>