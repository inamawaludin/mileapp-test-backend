<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Exceptions\AppException;
use App\Models\Package;
use Illuminate\Http\Response;

class ShipmentRepository implements ShipmentRepositoryInterface
{
    private $package;

    public function __construct(Package $package)
    {
        $this->package = $package;
    }

    public function all()
    {
        return $this->package->all();
    }

    public function create(array $data)
    {
        try {
            $package = $this->package->create($data);

            if (!$package) {
                $this->throwNotFound('Package not found');
            }

            return $package;
        } catch (\Exception $e) {
            $this->throwServerError('Error creating package');
        }
    }

    public function find($id)
    {
        $package = $this->package->find($id);

        if (!$package) {
            $this->throwNotFound('Package not found');
        }

        return $package;
    }

    public function update($id, array $data)
    {
        $package = $this->find($id);

        if (!$package) {
            $this->throwNotFound('Package not found');
        }

        try {
            $package->update($data);
            return $package;
        } catch (\Exception $e) {
            $this->throwServerError('Error updating package');
        }
    }

    public function delete($id)
    {
        $package = $this->find($id);

        if (!$package) {
            $this->throwNotFound('Package not found');
        }

        try {
            $package->delete();
        } catch (\Exception $e) {
            $this->throwServerError('Error deleting package');
        }
    }

    private function throwNotFound($message)
    {
        throw new AppException($message, Response::HTTP_NOT_FOUND);
    }

    private function throwServerError($message)
    {
        throw new AppException($message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
