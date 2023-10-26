<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:255|regex:/^[\pL\s-]+$/u',
            //regex:/^[a-zA-Z\p{Arabic}0-9\s\-]+$/u for accept letters or numbers only
            //regex:/^[\pL\s-]+$/u not accept numbers
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|min:10|max:15|unique:users,phone|regex:/(^01[0125][0-9]{8}$)/',
            'password' => 'required|min:8|max:25|confirmed',
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => ' نوع الحساب مطلوب ',
            'name.required' => 'الأسم مطلوب',
            'name.regex' => 'الأسم يجب أن يكون حروف فقط ',
            'name.max' => 'الأسم عدد الحروف لا تتجاوز 255 حرف',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة',
            'email.unique' => 'البريد الإلكتروني موجود من قبل',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.min' => 'يجب أن يكون رقم الهاتف أكبر من 9 أرقام',
            'phone.max' => 'يجب أن يكون رقم الهاتف أقل من أو يساوي 15 رقم',
            'phone.unique' => 'رقم الهاتف موجود من قبل',
            'phone.regex' => 'رقم الهاتف يجب أن يكون رقم هاتف مصري',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'يجب أن يكون كلمة المرور أكبر من أو يساوي 8 أرقام أو حروف',
            'password.max' => 'يجب أن يكون  كلمة المرور أقل من أو يساوي 25 رقم أو حرف',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
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
