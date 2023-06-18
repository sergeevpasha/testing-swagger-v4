<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\ModelInterface;
use App\Models\User;
use App\Repository\Contracts\UserRepositoryContract;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    private ModelInterface $user;

    /**
     * @param \App\Models\User $model
     */
    public function __construct(User $model)
    {
        $this->setModel($model);
    }

    public function setModel(ModelInterface $model): void
    {
        $this->user = $model;
    }

    public function getModel(): ModelInterface
    {
        return $this->user;
    }
}
