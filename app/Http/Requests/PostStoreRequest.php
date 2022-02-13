<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'content' => ['required'],
            'category' => ['exists:categories,id'],
            'thumbnail' => ['image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
            'bg_image' =>  ['image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ];
    }
}
