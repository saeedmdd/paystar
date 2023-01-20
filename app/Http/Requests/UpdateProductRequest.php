<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "title" => "required|string|max:255",
            "description" => "required|string|max:1000",
            "image" => "image|mimes:jpg,png",
            "price" => "required|numeric|max:100000000"
        ];
    }
}
