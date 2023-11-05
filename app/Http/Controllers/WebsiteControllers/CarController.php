<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Requests\CarRequest;
use App\Http\Requests\CarReservationRequest;
use App\Models\Car;
use App\Models\CarsBrand;
use App\Models\CarsModel;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Tanant;
use App\Traits\MainTrait;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CarController extends Controller
{
    use MainTrait;


    //Brands
    public function get_all_cars_brands()
    {
        try {
            $brands = CarsBrand::orderBy('brand_name')->get();
            return $this->successResponse('جميع الماركات', $brands);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    //Models
    public function get_all_cars_brand_models()
    {
        try {
            $models = CarsModel::where('brand_id',\request('brand_id'))->orderBy('model_name')->get();
            return $this->successResponse('الموديلات', $models);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    //Get all cars
    public function get_all_cars(Request $request)
    {
        try {
            $cars = Car::with(['user.vendor', 'brands'])->vendorStatus()->filter($request)->latest()->get();
            return $this->successResponse('جميع السيارات', $cars);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
    public function get_all_cars_pagination(Request $request)
    {
        try {
            $cars = Car::with(['user.vendor', 'brands'])->vendorStatus()->filter($request)->latest()->paginate($this->paginate);
            return $this->successResponse('جميع السيارات', $cars);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    //Get Single Car
    public function get_single_car($id)
    {
        try {

            $car = Car::with(['user.vendor', 'brands'])->vendorStatus()->find($id);
            if(!$car)
            {
                return $this->errorResponse('هذه العربية غير موجودة');
            }
            return $this->successResponse('بيانات السيارة', $car);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }


    //check_car_availability
    public function check_car_availability($carID)
    {
        $tanant_car_exists = Tanant::where('car_id',$carID)->get();
        $dates_of_car = [];
        foreach ($tanant_car_exists as $val)
        {
            if($val->status =='approved')
            {
                $period = CarbonPeriod::create($val->from_date, $val->to_date);
                foreach ($period as $date) {
                    array_push($dates_of_car, $date->format('Y-m-d'));
                }
            }
        }
        return $this->successResponse('الأيام المحجوزة للسيارة', $dates_of_car);
    }

    //User Reserve car
    public function reserve_car(CarReservationRequest $request){
        try {

            $data = $request->validated();
            if ($request->hasFile('nid_img')) {
                $image = $this->uploadFile($request, 'nid_img', 'uploads/');
                $data['nid_img'] = $image;
            }
            if ($request->hasFile('license_img')) {
                $image = $this->uploadFile($request, 'license_img', 'uploads/');
                $data['license_img'] = $image;
            }
            $data['user_id'] = (Auth::user())? Auth::user()->id : null;
            $data['status'] = 'pending';
            $car = Car::with('user.vendor')->findOrFail($data['car_id']);
            if(empty($car)){
                return $this->errorResponse('السيارة غير موجودة');
            }

            $data['from_date'] =  date('Y-m-d', strtotime($data['from_date']));
            $data['to_date'] =  date('Y-m-d', strtotime($data['to_date']));

            //Check if car reserved or not in the notice and status approved
            $this->check_if_car_reserved_or_not($data['from_date'], $data['to_date'],$car->id);

            //Some Inputs like : days and total amount and discount
            $data['days'] =  dateDiffInDays($data['from_date'],$data['to_date']);
            $data['discount_percentage'] =  getSettings('discount_percentage');
            $data['total_amount'] = $this->get_total_amount($data['days'] , $car->price_per_day);
            $data['total_amount_after_discount'] = $this->get_total_amount_after_discount($data['total_amount'], $data['discount_percentage']);
            $data['vendor_user_id'] = $car->user_id;
            $data['car_details'] = json_encode($car);
            $tanant = Tanant::create($data);
            //Send Mail to Vendor
            $type = 'vendor';
            $html = view('emails.reservation_notification', compact('tanant', 'type'))->render();
            $this->sendEmail($tanant->vendor_user?->email,'كاركيتس',$html, "كاركيتس | طلب حجز سيارة");


            return $this->successResponse('تم إضافة الطلب بنجاح', $tanant);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }


    //search_cars_in_home_page
    public function search_cars(Request $request)
    {
        $cars = Car::search($request)->latest()->get();
        return $this->successResponse('السيارات المتاحة', $cars);
    }


}
