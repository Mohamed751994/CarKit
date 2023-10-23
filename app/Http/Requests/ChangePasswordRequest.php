<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'encrypt_user_id' =>'nullable',
            'password' => 'required|min:8|max:25|confirmed',
        ];
    }


    public function messages()
    {
        return [

            'password.required' => 'كلمة المرور الجديدة مطلوبة',
            'password.min' => 'يجب أن يكون كلمة المرور أكبر من أو يساوي 8 أرقام أو حروف',
            'password.max' => 'يجب أن يكون  كلمة المرور  أقل من أو يساوي 25 رقم أو حرف',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
        ];
    }

}
