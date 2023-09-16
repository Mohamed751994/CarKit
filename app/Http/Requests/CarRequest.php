<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'year'=> 'required|max:255',
            'fuel_type'=> 'required|max:255',
            'motor_type'=> 'required|max:255',
            'cc'=> 'required|max:255',
            'kilometers'=> 'required|max:255',
            'color'=> 'required|max:255',
            'seats'=> 'required|max:255',
            'doors'=> 'required|max:255',
            'outside_look'=> 'required|max:255',
            'additions'=> 'nullable|max:255',
            'image' => 'required|mimes:png,jpg,jpeg,webp,svg,gif,jiff|max:5000',
            'price_per_day'=> 'required|max:255',
            'central_point_pickup'=> 'required|max:255',
            'features'=> 'nullable|max:255',
        ];
    }

    public function messages()
    {
        return [
            'brand.required' => 'البراند  مطلوب',
            'model.required' => 'الموديل  مطلوب',
            'year.required' => 'سنة الصنع  مطلوب',
            'fuel_type.required' => 'نوع الوقود  مطلوب',
            'motor_type.required' => 'ناقل الحركة  مطلوب',
            'cc.required' => 'سعة المحرك  مطلوب',
            'kilometers.required' => 'عدد الكيلومترات  مطلوب',
            'color.required' => 'اللون  مطلوب',
            'seats.required' => 'عدد المقاعد  مطلوب',
            'doors.required' => 'عدد الأبواب  مطلوب',
            'outside_look.required' => 'الشكل الخارجي  مطلوب',
            'price_per_day.required' => 'السعر اليومي  مطلوب',
            'central_point_pickup.required' => ' عنوان التسليم والتسلم  مطلوب',
            'image.mimes' =>'يجب أن تكون صيغة الصورة (png - jpg - jpeg - webp - svg - gif) ',
            'image.max' =>'يجب أن لا تتعدي حجم الصورة 5 ميجا بايت',
        ];
    }

//    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
//    {
//        $response = new JsonResponse([
//            'success' => false,
//            'errors' => $validator->errors()
//        ], 422);
//
//        throw new \Illuminate\Validation\ValidationException($validator, $response);
//    }


}
