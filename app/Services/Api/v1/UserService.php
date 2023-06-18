<?php

declare(strict_types=1);

namespace App\Services\Api\v1;

use App\Http\Resources\Api\v1\UserResource;
use App\Repository\Contracts\UserRepositoryContract;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @var \App\Repository\Contracts\UserRepositoryContract
     */
    private UserRepositoryContract $repository;

    /**
     * @param \App\Repository\Contracts\UserRepositoryContract $repository
     */
    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find User by ID
     *
     * @param int $id
     *
     * @return \App\Http\Resources\Api\v1\UserResource
     */
    public function getById(int $id): UserResource
    {
        return new UserResource($this->repository->find($id));
    }

    /**
     * Create User
     *
     * @param array $user
     * @param bool  $autoLogin
     *
     * @return \App\Http\Resources\Api\v1\UserResource
     */
    public function create(array $user, bool $autoLogin = false): UserResource
    {
        $user['password'] = Hash::make($user['password']);

        /* @var \App\Models\User $userModel */
        $userModel = $this->repository->create($user);

        event(new Registered($userModel));

        if ($autoLogin) {
            Auth::guard()->login($userModel);
        }

        return new UserResource($user);
    }

    /**
     * Update User
     *
     * @param array $product
     * @param int   $id
     *
     * @return void
     */
    public function update(array $product, int $id): void
    {
        $this->repository->update($id, $product);
    }

    /**
     * Delete User
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->repository->delete($id);
    }
}
