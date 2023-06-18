<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'name'  => ['required', 'string'],
            'code'  => ['required', 'string', 'unique:products,code'],
            'price' => ['required', 'numeric', 'min:0']
        ];
    }
}
