<?php

namespace App\Traits;

use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

trait MainTrait
{
    //Success Response
    public function successResponse($message = '',$data = [],$statusCode = Response::HTTP_OK)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    //Error Response
    public function errorResponse($message = '', $statusCode=400)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $statusCode);
    }


    //Main Upload File Method
    public function uploadFile($request,$fileInputName, $moveTo)
    {

        $file = $request->file($fileInputName);
        $fileUploaded=rand(1,99999999999).'__'.$file->getClientOriginalName();
        $file->move($moveTo, $fileUploaded);
        return $fileUploaded;

    }


    //Full image path
    public function image_full_path($image)
    {
        return asset('/store/'. $image);
    }

    //Save Vendor Details when User Register
    public function save_new_vendor_details($user)
    {
        if($user->type == 'vendor')
        {
            Vendor::create([
                'user_id' => $user->id,
                'name' => $user->name,
            ]);
        }
    }

    //return auth user id
    public function user_id()
    {
        return auth()->user()->id;
    }


    //Sendgrid api emails
//    public function send_email_to_user($email, $name, $body, $subject)
//    {
//
//        $headers = array(
//            'Authorization: Bearer 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' ,
//            'Content-Type: application/json'
//        );
//
//        $data = array(
//            "personalizations" => array(
//                array(
//                    "to" => array(
//                        array(
//                            "email" => $email,
//                            "name" => $name
//                        ),
//                    )
//
//                )
//            ),
//            "from" => array(
//                "email" =>"mohamednaser@spcd.psu.edu.eg"
//            ),
//            "subject" => $subject,
//            "content" => array(
//                array(
//                    "type" => "text/html",
//                    "value" => $body
//                )
//            )
//        );
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        $response = curl_exec($ch);
//        curl_close($ch);
//        return $response;
//    }








}
