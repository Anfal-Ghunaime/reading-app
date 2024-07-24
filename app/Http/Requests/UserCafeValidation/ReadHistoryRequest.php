<?php

namespace App\Http\Requests\UserCafeValidation;

use Illuminate\Foundation\Http\FormRequest;

class ReadHistoryRequest extends FormRequest
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
            'read_date' => 'date',
            'total_read_time' => 'date_format:H:i:s',
        ];
    }
}
