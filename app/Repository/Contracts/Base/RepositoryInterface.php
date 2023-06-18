<?php

declare(strict_types=1);

namespace App\Repository\Contracts\Base;

use App\Models\ModelInterface;
use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{

    /**
     * Set Model
     *
     * @param \App\Models\ModelInterface $model
     *
     * @return void
     */
    public function setModel(ModelInterface $model): void;

    /**
     * Get Model
     *
     * @return \App\Models\ModelInterface
     */
    public function getModel(): ModelInterface;

    /**
     * Show all
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): Collection;

    /**
     * Find Model by ID
     *
     * @param int $id
     *
     * @return \App\Models\ModelInterface|null
     */
    public function find(int $id): ?ModelInterface;

    /**
     * Create Model
     *
     * @param array $data
     *
     * @return \App\Models\ModelInterface
     */
    public function create(array $data): ModelInterface;

    /**
     * Update Model
     *
     * @param int   $id
     * @param array $data
     *
     * @return void
     */
    public function update(int $id, array $data): void;

    /**
     * Delete Model by ID
     *
     * @param int $id
     *
     * @return void
     */
    public function delete(int $id): void;
}
