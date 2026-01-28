<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'full_name_english' => 'required|string|max:255',
            'full_name_bangla'  => 'required|string|max:255',
            'gender'            => 'required',
            'phone'             => 'required',
            'email'             => 'required|email|unique:students,email',
            'date_of_birth'     => 'required|date',

            'current_address'   => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'reference_name'    => 'nullable|string',

            'institute_id'      => 'required|exists:institutes,id',
            'trade_id'          => 'required|exists:trades,id',
            'course_id'         => 'required|exists:courses,id',

            'course_duration'   => 'required|integer',
            'course_fee'        => 'required|string',

            'card_file'         => 'nullable|file',
            'photo'             => 'nullable|image',

            'status'            => 'required'
        ];
    }
}
