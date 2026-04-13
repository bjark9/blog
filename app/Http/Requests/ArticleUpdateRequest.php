<?php
// php artisan make:request ArticleCreateRequest

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:articles,title|max:255'.$this->route('article')->id, 
            // Nous avons ajouté la règle unique:articles,title,{$id} pour vérifier que le titre est unique dans la table articles sauf pour l'article en cours de modification. Pour récupérer l'identifiant de l'article en cours de modification, nous utilisons la méthode route() de la Form Request. Cette méthode permet de récupérer les paramètres de la route.
            'published_at'=>'nullable|date',
            'img' => 'nullable|image|max:2048',
            'body'=>'required|max:1000',
        ];
    }
}
