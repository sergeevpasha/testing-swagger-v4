<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use Illuminate\Validation\Rule;

/**
 * @property mixed $product
 */
class UpdateProductRequest extends CreateProductRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array[]
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'name'  => ['string'],
            'code'  => ['string', Rule::unique('products', 'code')->ignore($this->product)],
            'price' => ['numeric', 'min:0']
        ]);
    }
}
