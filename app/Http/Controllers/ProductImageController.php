<?php

namespace App\Http\Controllers;

use App\DTOs\ProductImage\StoreDTO;
use App\DTOs\ProductImage\UpdateDTO;
use App\Http\Requests\ProductImage\StoreRequest;
use App\Http\Requests\ProductImage\UpdateRequest;
use App\Http\Resources\ProductImage\ProductImageResource;
use App\Services\ProductImage\DestroyService;
use App\Services\ProductImage\ListService;
use App\Services\ProductImage\ShowService;
use Symfony\Component\HttpFoundation\Response;
use App\Services\ProductImage\StoreService;
use App\Services\ProductImage\UpdateService;

class ProductImageController extends Controller
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
        $result = $this->listService->execute();
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => ProductImageResource::collection($result)], Response::HTTP_OK);
    }

    public function store(StoreRequest $request)
    {
        $dto = StoreDTO::fromRequest($request);
        $result = $this->storeService->execute($dto);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new ProductImageResource($result)], Response::HTTP_OK);
    }

    public function show($productImage_id)
    {
        $result = $this->showService->execute($productImage_id);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new ProductImageResource($result)], Response::HTTP_OK);
    }

    public function update(UpdateRequest $request, $productImage_id)
    {
        $dto = UpdateDTO::fromRequest($request);
        $result = $this->updateService->execute($dto, $productImage_id);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new ProductImageResource($result)], Response::HTTP_OK);
    }

    public function destroy($productImage_id)
    {
        $this->destroyService->execute($productImage_id);
        return response()->json(['message' => 'Solicitud procesada con exito.'], Response::HTTP_OK);
    }
}
