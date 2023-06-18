<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\ModelInterface;
use App\Repository\Contracts\Base\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * Instance of Eloquent Model
     *
     * @var \App\Models\ModelInterface
     */
    protected ModelInterface $model;

    /**
     * Show all
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): Collection
    {
        return $this->getModel()->all();
    }

    /**
     * Create Model
     *
     * @param array $data
     *
     * @return \App\Models\ModelInterface
     */
    public function create(array $data): ModelInterface
    {
        $model = $this->getModel()->create($data);
        return $model->fresh();
    }

    /**
     * Update Model
     *
     * @param int   $id
     * @param array $data
     *
     * @return void
     */
    public function update(int $id, array $data): void
    {
        $model = $this->getModel()->findOrFail($id);
        $model->update($data);
    }

    /**
     * Find Model by ID
     *
     * @param int $id
     *
     * @return \App\Models\ModelInterface|null
     */
    public function find(int $id): ?ModelInterface
    {
        return $this->getModel()->findOrFail($id);
    }

    /**
     * Delete Model by ID
     *
     * @param int $id
     *
     * @return void
     */
    public function delete(int $id): void
    {
        $this->getModel()->findOrFail($id)->delete();
    }
}
