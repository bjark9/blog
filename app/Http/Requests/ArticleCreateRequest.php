<?php
// php artisan make:request ArticleCreateRequest

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:articles|max:255',
            'published_at' => 'nullable|date',
            'img' => 'nullable|image|max:2048',
            'body' => 'required|max:10000',
        ];
    }
}
