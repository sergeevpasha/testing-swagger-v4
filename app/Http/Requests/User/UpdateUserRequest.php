<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;

/**
 * @property mixed $user
 */
class UpdateUserRequest extends CreateUserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array[]
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'email'                 => ['string', Rule::unique('users', 'email')->ignore($this->user)],
            'password'              => ['string', 'min:10', 'max:50'],
            'password_confirmation' => ['string', 'min:10', 'max:50'],
            'name'                  => ['string'],
        ]);
    }
}
