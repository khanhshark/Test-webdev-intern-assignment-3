<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentScoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'registration_number' => 'required|string|max:10|unique:student_scores,registration_number',
            'math'                => 'nullable|numeric|min:0|max:10',
            'literature'          => 'nullable|numeric|min:0|max:10',
            'foreign_language'    => 'nullable|numeric|min:0|max:10',
            'physics'             => 'nullable|numeric|min:0|max:10',
            'chemistry'           => 'nullable|numeric|min:0|max:10',
            'biology'             => 'nullable|numeric|min:0|max:10',
            'history'             => 'nullable|numeric|min:0|max:10',
            'geography'           => 'nullable|numeric|min:0|max:10',
            'civic_education'     => 'nullable|numeric|min:0|max:10',
            'foreign_language_code' => 'nullable|string|max:5',
        ];
    }

    public function messages()
    {
        return [
            'registration_number.required' => 'Số báo danh không được để trống.',
            'registration_number.unique' => 'Số báo danh đã tồn tại.',
            'math.numeric' => 'Điểm toán phải là số.',
            'math.min' => 'Điểm toán không được nhỏ hơn 0.',
            'math.max' => 'Điểm toán không được lớn hơn 10.'
        ];
    }
}
