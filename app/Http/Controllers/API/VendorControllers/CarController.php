<?php

namespace App\Http\Controllers\API\VendorControllers;

use App\Http\Requests\CarRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use App\Models\CarFeature;
use App\Models\User;
use App\Models\Vendor;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CarController extends Controller
{
    use MainTrait;

    //Vendor Create new Car
    public function create_new_car(CarRequest $request)
    {
//        DB::beginTransaction();
//        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $image = $this->uploadFile($request, 'image', 'uploads/');
                $data['image'] = $image;
            }
            if ($request->hasFile('images')) {
                $multipleImages = $this->uploadMultipleFile($request,'images', 'uploads/');
                $data['images'] = $multipleImages;
            }
            if ($request->hasFile('license')) {
                $license = $this->uploadMultipleFile($request,'license', 'uploads/');
                $data['license'] = $license;
            }
            $car = Car::create(Arr::except($data, ['features']));
            if(isset($data['features']) && count($data['features']) > 0)
            {
                foreach ($data['features'] as $feature)
                {
                    CarFeature::create(['car_id' =>$car->id,'name'=> $feature->name, 'price' =>($feature->price) ? $feature->price : 0]);
                }
            }
         //   DB::commit();
            return $this->successResponse('تم إضافة السيارة بنجاح', [$car]);
//        } catch (\Throwable $th) {
//            DB::rollback();
//            return $this->errorResponse($th->getMessage());
//        }
    }

    public function get_vendor_cars()
    {
        try {

            $user_id = $this->user_id();
            $cars = Car::where('user_id', $user_id)->latest()->get();

            $vendor_name = Auth::user()->name;
            return $this->successResponse("سيارات التاجر ($vendor_name)", $cars);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }


    public function get_vendor_cars_pagination()
    {
        try {

            $user_id = $this->user_id();
            $cars = Car::where('user_id', $user_id)->latest()->paginate($this->paginate);

            $vendor_name = Auth::user()->name;
            return $this->successResponse("سيارات التاجر ($vendor_name)", $cars);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }



    public function get_single_car($id)
    {
        try {
            $car = Car::with(['user.vendor', 'brands'])->find($id);
            if(!$car)
            {
                return $this->errorResponse('هذه العربية غير موجودة');
            }
            return $this->successResponse('بيانات السيارة', $car);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }


    //Vendor Update his car
    public function vendor_update_his_car(CarUpdateRequest $request, $id)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $image = $this->uploadFile($request, 'image', 'uploads/');
                $data['image'] = $image;
            }
            if ($request->hasFile('imagesList')) {
                $multipleImages = $this->uploadMultipleFile($request,'imagesList', 'uploads/');
                $data['imagesList'] = $multipleImages;
            }
            if ($request->hasFile('license')) {
                $license = $this->uploadMultipleFile($request,'license', 'uploads/');
                $data['license'] = $license;
            }
            Car::where('user_id', $this->user_id())->whereId($id)->update($data);
            return $this->successResponse('تم تعديل السيارة بنجاح');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    //Vendor Active / Unactive his car
    public function vendor_status_his_car(Request $request,$id)
    {
        try {
            $car = Car::where('user_id', $this->user_id())->find($id);
            if(!$car)
            {
                return $this->errorResponse('هذه السيارة غير موجودة');
            }
            $car->update(['status'=>$request->status]);
            $message = $request->status == 1 ? 'تم نشر السيارة بنجاح' : 'تم حذف السيارة من العرض بنجاح ';
            return $this->successResponse($message);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }


    //Vendor Automatic Approved
    public function automatic_approved(Request $request,$id)
    {
        try {
            $car = Car::where('user_id', $this->user_id())->find($id);
            if(!$car)
            {
                return $this->errorResponse('هذه السيارة غير موجودة');
            }
            $car->update(['automatic_approved'=>$request->automatic_approved]);
            $message = $request->automatic_approved == 1 ? 'أصبح الحجز علي هذه السيارة موافقة تلقائية' : 'أصبح الحجز علي هذه السيارة ينتظر الموافقة ';
            return $this->successResponse($message);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

}
