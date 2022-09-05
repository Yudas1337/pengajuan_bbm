<?php

namespace App\Interfaces;

interface BaseInterface
{
    /**
     * Handle the Get all data event from models.
     *
     * 
     * @return mixed
     */

    public function getAll(): mixed;

    /**
     * Handle store data event to models.
     *
     * @param array $data
     * 
     * @return mixed
     */

    public function store(array $data): mixed;

    /**
     * Handle get the specified data by id from models.
     *
     * @param mixed $id
     * 
     * @return mixed
     */

    public function show(mixed $id): mixed;

    /**
     * Handle show method and update data instantly from models.
     *
     * @param mixed $id
     * @param array $data
     * 
     * @return mixed
     */

    public function update(mixed $id, array $data): mixed;

    /**
     * Handle show method and delete data instantly from models.
     *
     * @param mixed $id
     * 
     * @return mixed
     */

    public function destroy(mixed $id): mixed;

    /**
     * Handle count all data event from models.
     *
     * 
     * @return mixed
     */

    public function countAll(): mixed;
}
