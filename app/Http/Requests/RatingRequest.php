<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RatingRequest extends FormRequest
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
            'type' => 'required|max:255',
            'type_id' => 'required|integer',
            'rate' => 'required|in:1,2,3,4,5',
            'comment' => 'nullable',
        ];
    }


    public function messages()
    {
        return [
            'type.required' => 'النوع مطلوب',
            'type_id.required' => 'الid المراد تقييمه مطلوب',
            'rate.required' => 'التقييم مطلوب',
            'rate.in' => 'التقييم يجب أن يكون بين 1 و 5',
        ];
    }


}
