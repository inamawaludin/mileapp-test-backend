<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Services\ShipmentService;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    protected $shipmentService;

    public function __construct(ShipmentService $shipmentService)
    {
        $this->shipmentService = $shipmentService;
    }

    public function index()
    {
        $packages = $this->shipmentService->getAllShipment();
        return response()->json($packages);
    }

    public function show($id)
    {
        $package = $this->shipmentService->getShipmentById($id);
        return response()->json($package);
    }

    public function store(StoreShipmentRequest $request)
    {
        $package = $this->shipmentService->createShipment($request->all());
        return response()->json($package, 201);
    }

    public function update(UpdateShipmentRequest $request, $id)
    {

        $package = $this->shipmentService->updateShipment($id, $request->all());
        return response()->json($package);
    }

    public function destroy($id)
    {
        $this->shipmentService->deleteShipment($id);
        return response()->json(['message' => 'Package deleted']);
    }
}
