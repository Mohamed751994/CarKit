<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class VendorDetailsRequest extends FormRequest
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
            'name' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp,svg,gif,jiff|max:5000',
            'google_map' => 'nullable',
            'working_hours' => 'nullable|max:255',
            'id_images.*' => 'nullable|mimes:png,jpg,jpeg,webp,svg,gif,jiff,pdf,doc,docx|max:10000',
            'commercial_images.*' => 'nullable|mimes:png,jpg,jpeg,webp,svg,gif,jiff,pdf,doc,docx|max:10000',
            'tax_images.*' => 'nullable|mimes:png,jpg,jpeg,webp,svg,gif,jiff,pdf,doc,docx|max:10000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم المعرض مطلوب',
            'image.mimes' =>'يجب أن تكون صيغة الصورة (png - jpg - jpeg - webp - svg - gif) ',
            'image.max' =>'يجب أن لا تتعدي حجم الصورة 5 ميجا بايت',
            'id_images.*.mimes' =>'يجب أن تكون صيغة صورة أو ملف البطاقة الشخصية (png - jpg - jpeg - webp - svg - gif - pdf - doc - docx) ',
            'id_images.*.max' =>'يجب أن لا تتعدي حجم صورة أو ملف البطاقة الشخصية  10 ميجا بايت',
            'commercial_images.*.mimes' =>'يجب أن تكون صيغة صورة أو ملف السجل التجاري (png - jpg - jpeg - webp - svg - gif - pdf - doc - docx) ',
            'commercial_images.*.max' =>'يجب أن لا تتعدي حجم صورة أو ملف السجل التجاري 10 ميجا بايت',
            'tax_images.*.mimes' =>'يجب أن تكون صيغة صورة أو ملف البطاقة الضريبية (png - jpg - jpeg - webp - svg - gif - pdf - doc - docx) ',
            'tax_images.*.max' =>'يجب أن لا تتعدي حجم صورة أو ملف البطاقة الضريبية 10 ميجا بايت',
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
