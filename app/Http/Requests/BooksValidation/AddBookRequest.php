<?php

namespace App\Http\Requests\BooksValidation;

use Illuminate\Foundation\Http\FormRequest;

class AddBookRequest extends FormRequest
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
            'book' => ['required','file','mimes:pdf'],
            'name' => ['required'],
            'writer' => ['required'],
            'cover' => ['image','mimes:jpeg,png,jpg,gif,svg,bmp'],
            'summary' ,
            'lang',
            'pages' => 'required',
            'published_at',
            'is_novel' => 'required',
            'locked' ,
            'points' ,
        ];
    }
}
