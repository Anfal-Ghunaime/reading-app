<?php

namespace App\Http\Requests\QuotesValidation;

use Illuminate\Foundation\Http\FormRequest;

class QuoteDataRequest extends FormRequest
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
            'quote' => 'sometimes|string',
            'source_id' => 'sometimes|exists:books,book_id',
            'book_name' => 'sometimes',
            'author' => 'sometimes',
            'page_num' => 'sometimes',
            'my_thoughts' => 'sometimes',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,bmp',
        ];
    }
}
