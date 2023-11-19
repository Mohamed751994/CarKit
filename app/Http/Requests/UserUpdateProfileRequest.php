<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UserUpdateProfileRequest extends FormRequest
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
            'image' => 'nullable|mimes:png,jpg,jpeg,webp,svg,gif,jiff|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الأسم  مطلوب',
            'name.regex' => 'الأسم يجب أن يكون حروف فقط ',
            'name.max' => 'الأسم يجب أن لا يتعدي 255 حرف',
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
