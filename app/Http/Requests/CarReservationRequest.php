<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarReservationRequest extends FormRequest
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
            'user_id' => 'nullable',
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'age'=> 'required|gt:17|lte:100',
            'email'=> 'required|max:255',
            'phone'=> 'required|regex:/(^01[0125][0-9]{8}$)/',
            'trip_num'=> 'required|max:6|unique:tanants',
            'nid_img'=> 'required|mimes:png,jpg,jpeg,webp,svg,gif,jiff|max:5000',
            'license_img'=> 'required|mimes:png,jpg,jpeg,webp,svg,gif,jiff|max:5000',
            'status'=> 'nullable|in:pending,approved,rejected,cancelled',
            'from_date'=> 'required|date|after:today',
            'to_date'=> 'required|date|after:from_date',
            'car_id'=> 'required|max:255',
            'vendor_user_id'=> 'nullable|max:255',
            'car_details'=> 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'fname.required' => 'الاسم الاول  مطلوب',
            'lname.required' => 'الاسم الاخير  مطلوب',
            'age.required' => 'العمر  مطلوب',
            'age.gt' => 'العمر  يجب ان يكون اكبر من او يساوي 18 سنه',
            'age.lte' => 'العمر  يجب ان يكون اقل من او يساوي 100 سنه',
            'email.required' => ' البريد الالكتروني  مطلوب',
            'phone.required' => 'الهاتف مطلوب',
            'trip_num.required' => 'رقم الرحلة مطلوب',

            'image.mimes' =>'يجب أن تكون صيغة الصورة (png - jpg - jpeg - webp - svg - gif) ',
            'image.max' =>'يجب أن لا تتعدي حجم الصورة 5 ميجا بايت',

            'from_date.required' => ' تاريخ البداية  مطلوب',
            'to_date.required' => ' تاريخ النهاية  مطلوب',
            'car_id.required' => ' معرف السيارة  مطلوب',
        ];
    }
}
