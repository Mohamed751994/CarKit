<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class SettingRequest extends FormRequest
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

            'website_name'=> 'nullable|max:255',
            'website_url'=> 'nullable|max:255|url',
            'website_logo' => 'nullable|mimes:png|max:1000',
            'contacts'=> 'nullable',
            'terms'=> 'nullable',
            'policy'=> 'nullable',
            'facebook'=> 'nullable|max:255',
            'twitter'=> 'nullable|max:255',
            'linkedin'=> 'nullable|max:255',
            'tiktok'=> 'nullable|max:255',
            'instagram'=> 'nullable|max:255',
            'discount_percentage'=> 'nullable|integer|between:0,100',
        ];
    }

    public function messages()
    {
        return [
            'website_url'=> 'صيغة رابط الموقع غير صحيح',
            'image.mimes' =>'يجب أن تكون صيغة الصورة (png) فقط ',
            'image.max' =>'يجب أن لا تتعدي حجم الصورة 1 ميجا بايت',
            'discount_percentage.between'=> 'يجب أن تكون نسبة الخصم من 0 ل 100',

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
