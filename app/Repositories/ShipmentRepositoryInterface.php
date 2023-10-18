<?php

declare(strict_types=1);

namespace App\Repositories;

interface ShipmentRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
}
