<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'name' => [
                'required',
                'string'
            ],
            'description' => [
                'required'
            ],
            'image' => [
                'nullable',
                'mimes:jpg,png,jpeg'
            ],
            'price' =>[
                'required',
                'integer'
            ],
            'category_id'=>[
                'required',
                'integer'
            ]
        ];
    }
}
