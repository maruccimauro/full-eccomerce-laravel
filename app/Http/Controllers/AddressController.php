<?php

namespace App\Http\Controllers;

use App\Services\Address\ListService;
use App\Http\Resources\Address\AddressResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Address\StoreRequest;
use App\Http\Requests\Address\UpdateRequest;
use App\DTOs\Address\StoreDTO;
use App\DTOs\Address\UpdateDTO;
use App\Services\Address\DestroyService;
use App\Services\Address\ShowService;
use App\Services\Address\StoreService;
use App\Services\Address\UpdateService;

class AddressController extends Controller
{
    public function __construct(
        private ListService $listService,
        private StoreService $storeService,
        private ShowService $showService,
        private UpdateService $updateService,
        private DestroyService $destroyService
    ) {}

    public function index()
    {
        $addresses = $this->listService->execute();
        return response()->json(['message' => 'Solicitud procesada con exito', 'data' => AddressResource::collection($addresses)], Response::HTTP_OK);
    }

    public function store(StoreRequest $request)
    {
        $dto = StoreDTO::fromRequest($request);
        $address = $this->storeService->execute($dto);
        return response()->json(['message' => 'Solicitud procesada con exito', 'data' => new AddressResource($address)], Response::HTTP_CREATED);
    }

    public function show(int $address_id)
    {
        $address = $this->showService->execute($address_id);
        return response()->json(['message' => 'Solicitud procesada con exito', 'data' => new AddressResource($address)], Response::HTTP_OK);
    }

    public function update(UpdateRequest $request, int $address_id)
    {
        $dto = UpdateDTO::fromRequest($request);
        $address = $this->updateService->execute($dto, $address_id);
        return response()->json(['message' => 'Solicitud procesada con exito', 'data' => new AddressResource($address)], Response::HTTP_OK);
    }

    public function destroy(int $address_id)
    {
        $this->destroyService->execute($address_id);
        return response()->json(['message' => 'Solicitud procesada con exito.'], Response::HTTP_OK);
    }
}
