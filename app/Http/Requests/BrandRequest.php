<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        $model_names = request()->isMethod('put') ? 'required' : 'nullable';
        return [
            'brand_name' => 'required|max:255',
            'model_name.*' => 'nullable',
        ];
    }


    public function messages()
    {
        return [

            'brand_name.required' => 'اسم الماركة مطلوب',
            'model_name.*.required' => 'اسم الموديل مطلوب',
        ];
    }

}
