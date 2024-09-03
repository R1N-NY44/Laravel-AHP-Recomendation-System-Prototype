<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to this request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_internship' => 'required|integer|exists:internships,id_internship',
            'nim' => ['required', 'string', 'max:15', Rule::unique('values', 'nim')],
            'name' => 'required|string|max:50',
            'ipk' => 'required|numeric|between:0,4.00',
            'candidate' => 'required|array',
            'candidate.*.course' => 'required|integer|exists:courses,id_course',
            'candidate.*.weight' => 'required|numeric|min:10|max:100', // Assuming weight should be in the range [10, 100]
        ];
    }
}
