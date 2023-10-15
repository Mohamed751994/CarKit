<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required',
            'type' => 'nullable'
        ];
    }


    public function messages()
    {
        return [

            'email.required' => 'البريد الإلكتروني مطلوب',
            'password.required' => 'كلمة المرور مطلوبة',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        if (Request::is('api/*'))
        {
            $response = new JsonResponse([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);

            throw new \Illuminate\Validation\ValidationException($validator, $response);
        }

    }


}
