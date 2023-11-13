<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WishlistRequest extends FormRequest
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
            'car_id' => 'required|integer',
        ];
    }


    public function messages()
    {
        return [
            'car_id.required' => 'حدد السيارة أولاً',
            'car_id.integer' => 'يجب أن ترسل رقم السيارة فقط',
        ];
    }

}
