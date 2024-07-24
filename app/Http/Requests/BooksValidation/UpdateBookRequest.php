<?php

namespace App\Http\Requests\BooksValidation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'book' => 'sometimes|file|mimes:pdf',
            'name' => 'sometimes',
            'writer' => 'sometimes',
            'cover' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,bmp',
            'summary' => 'sometimes',
            'lang' => 'sometimes',
            'pages_num' => 'sometimes',
            'published_at' => 'sometimes',
            'is_novel' => 'sometimes',
            'is_locked' => 'sometimes',
            'points' => 'sometimes',
        ];
    }
}
