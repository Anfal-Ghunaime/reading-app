<?php

namespace App\Http\Requests\ProfileValidation;

use Illuminate\Foundation\Http\FormRequest;

class ProfileDataRequest extends FormRequest
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
            'name' => 'sometimes',
            'profile_photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,bmp',
            'bio' => 'sometimes'
        ];
    }
}
