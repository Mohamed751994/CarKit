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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|min:6|max:20|unique:users,phone',
            'password' => 'required|min:8|max:25|confirmed',
            'type' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الأسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة',
            'email.unique' => 'البريد الإلكتروني موجود من قبل',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.min' => 'يجب أن يكون رقم الهاتف أكبر من 5 أرقام',
            'phone.max' => 'يجب أن يكون رقم الهاتف أقل من أو يساوي 20 رقم',
            'phone.unique' => 'رقم الهاتف موجود من قبل',
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
