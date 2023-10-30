<?php

namespace App\Traits;

use App\Models\Tanant;
use App\Models\Vendor;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

trait MainTrait
{
    public $insertMsg = ' تم إنشاء العنصر بنجاح ';
    public $updateMsg = 'تم تحديث العنصر بنجاح';
    public $deleteMsg = 'تم حذف العنصر بنجاح';
    public $error = 'يوجد مشكلة ما';

    public $paginate = 50;



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
        return asset('/uploads/'. $image);
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

    //return total amount
    public function get_total_amount($days, $price_per_day)
    {
        return ($days * $price_per_day);
    }

    //return total amount after discount
    public function get_total_amount_after_discount($total_amount, $discount)
    {
        return  $total_amount - ($total_amount * $discount / 100);
    }


    //Change Status
    public function quickChangeTrait($request)
    {
        $model = $request->model;
        $id = $request->id;
        $val = $request->val;
        $col = $request->col;
        if($model == 'Vendor')
        {
            Vendor::whereId($id)->update([$col=> $val]);
        }
        return response()->json(['success'=>true]);
    }



    //get all dates between two dates
    function get_dates_between_two_dates_for_car($car)
    {
        $tanant_car_exists = Tanant::where('car_id',$car->id)->get();
        $dates_of_car = [];
        foreach ($tanant_car_exists as $val)
        {
            $period = CarbonPeriod::create($val->from_date, $val->to_date);
            foreach ($period as $date) {
                array_push($dates_of_car, [ 'status'=>$val->status ,'date' =>$date->format('Y-m-d')]);
            }
        }
        return $dates_of_car;
    }
    // check availability
    function check_if_car_reserved_or_not($request , $car)
    {
        $request_coming_dates = CarbonPeriod::create($request->from_date, $request->to_date);
        foreach ($this->get_dates_between_two_dates_for_car($car) as $status_and_date)
        {
            foreach ($request_coming_dates as $requestDate) {
                if($status_and_date['status'] == 'approved' && ($requestDate->format('Y-m-d') === $status_and_date['date']))
                {
                    return $this->errorResponse('عفواً السيارة محجوزة في الفترة الحالية');
                }
            }
        }
    }



    //Sendgrid api emails
    public function sendEmail($email, $name, $body, $subject)
    {

        $headers = array(
            'Authorization: Bearer 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' ,
            'Content-Type: application/json'
        );

        $data = array(
            "personalizations" => array(
                array(
                    "to" => array(
                        array(
                            "email" => $email,
                            "name" => $name
                        ),
                    )

                )
            ),
            "from" => array(
                "email" =>"mohamed.gamal@khomrigroup.com"
            ),
            "subject" => $subject,
            "content" => array(
                array(
                    "type" => "text/html",
                    "value" => $body
                )
            )
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }








}
