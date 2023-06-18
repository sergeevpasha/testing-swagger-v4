<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int    $id
 * @property string $email
 * @property string $name
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array[]
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'email' => $this->email,
            'name'  => $this->name,
        ];
    }
}
