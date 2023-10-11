<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class VendorDataRequest extends FormRequest
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
        $user =  User::find(\Request::segment(3));
        $email = request()->isMethod('put') ?
            'required|email|unique:users,email,'.$user->id.',id' :
            'required|email|unique:users,email';
        $phone = request()->isMethod('put') ?
            'required|min:8|max:25|unique:users,phone,'.$user->id.',id' :
            'required|min:8|max:25|unique:users,phone';

        $password = request()->isMethod('put') ?
            'nullable|min:8|max:25|confirmed' :
            'required|min:8|max:25|confirmed';
        return [
            'name' => 'required|max:255',
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'type' => 'nullable',
            'address' => 'required|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp,svg,gif|max:5000',
            'google_map' => 'nullable',
            'working_hours' => 'nullable',
            'status' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الأسم  مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة',
            'email.unique' => 'البريد الإلكتروني موجود من قبل',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.min' => 'يجب أن يكون رقم الهاتف أكبر من 7 أرقام',
            'phone.max' => 'يجب أن يكون رقم الهاتف أقل من أو يساوي 25 رقم',
            'phone.unique' => 'رقم الهاتف موجود من قبل',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'يجب أن يكون كلمة المرور أكبر من أو يساوي 8 أرقام أو حروف',
            'password.max' => 'يجب أن يكون  كلمة المرور أقل من أو يساوي 25 رقم أو حرف',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
            'address.required' => ' العنوان مطلوب',
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
