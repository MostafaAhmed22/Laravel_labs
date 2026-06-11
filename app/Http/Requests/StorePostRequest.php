<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MaxThreePosts;
use Symfony\Component\Mime\MimeTypes;

class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>['required','string','min:3','unique:posts,title', new MaxThreePosts],
            'description'=>['required','string','min:10'],
            //must be image not anything else
            'image' => ['nullable', 'image', 'max:2048']
            // 'slug'=>['required','string','min:3','unique:posts,slug']
            //
        ];
    }
}
