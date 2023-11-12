<?php

namespace App\Http\Controllers\API\VendorControllers;

use App\Http\Requests\ChangeReservationStatusRequest;
use App\Http\Requests\VendorDetailsRequest;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Tanant;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    use MainTrait;

    public function update_vendor_details(VendorDetailsRequest $request)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $image = $this->uploadFile($request,'image', 'uploads/');
                $data['image'] = $image;
            }
            if(isset($data['name']))
            {
                User::whereId($this->user_id())->update(['name'=>$data['name']]);
            }
            Vendor::where('user_id',$this->user_id())->update($data);
            return $this->successResponse('تم تعديل بيانات المعرض بنجاح');
        } catch (\Throwable $th) {
        return $this->errorResponse($th->getMessage());
        }
    }

    public function get_vendor_cars_reservation()
    {
        try {
            $reservations = Tanant::where('vendor_user_id',$this->user_id())->latest()->get();

            foreach ($reservations as $key => $reservation) {
                $reservation['car_details'] = json_decode($reservation['car_details']);
            }

            return $this->successResponse('بيانات التأجير', $reservations);
        } catch (\Throwable $th) {
        return $this->errorResponse($th->getMessage());
        }
    }

    public function get_vendor_cars_reservation_pagination()
    {
        try {
            $reservations = Tanant::where('vendor_user_id',$this->user_id())->latest()->paginate($this->paginate);

            foreach ($reservations as $key => $reservation) {
                $reservation['car_details'] = json_decode($reservation['car_details']);
            }

            return $this->successResponse('بيانات التأجير', $reservations);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    //get_vendor_single_reserve
    public function get_vendor_single_reserve($id)
    {
        try {
            $reservation = Tanant::where('vendor_user_id', $this->user_id())->whereId($id)->first();
            if(!$reservation)
            {
                return $this->errorResponse('الحجز غير موجود');
            }
            $reservation['car_details'] = json_decode($reservation['car_details']);
            return $this->successResponse('حجوزاتي ', $reservation);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    //Vendor Change Status of reservation
    public function change_reservation_status(ChangeReservationStatusRequest $request, $id)
    {
        try {
            $status = $request->status;
            $tanant = Tanant::with('normal_user')->whereId($id)->where('vendor_user_id', $this->user_id())->first();
            if(!$tanant)
            {
                return $this->errorResponse('هذا الحجز غير موجود');
            }
            if($tanant->status != 'pending')
            {
                return $this->errorResponse('عفواً تم تغيير الحالة من قبل');
            }
            if($status == 'approved')
            {
                //Check if car reserved or not in the notice and status approved
                $this->check_if_car_reserved_or_not($tanant->from_date, $tanant->to_date,$tanant->car_id);
            }
            $tanant->update(['status'=>$status]);

            //Send Mail To User
            $type = 'user';
            $html = view('emails.reservation_notification', compact('tanant', 'type'))->render();
            $subject = ($status == 'approved') ? 'تم قبول طلب الحجز الخاص بك' : 'تم رفض طلب الحجز الخاص بك ';
            $this->sendEmail($tanant->normal_user?->email,'كاركيتس',$html, "كاركيتس | $subject");


            return $this->successResponse('تم تعديل حالة الحجز بنجاح');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }


}
