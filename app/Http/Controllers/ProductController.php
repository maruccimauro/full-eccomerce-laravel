<?php

namespace App\Http\Controllers;

use App\DTOs\Product\StoreDTO;
use App\DTOs\Product\UpdateDTO;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductResource;
use App\Services\Product\DestroyService;
use App\Services\Product\ListService;
use App\Services\Product\ShowService;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Product\StoreService;
use App\Services\Product\UpdateService;

class ProductController extends Controller
{

    public function __construct(
        private ListService $listService,
        private StoreService $storeService,
        private ShowService $showService,
        private UpdateService $updateService,
        private DestroyService $destroyService,
    ) {}

    public function index()
    {
        $result = $this->listService->execute();
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => ProductResource::collection($result)], Response::HTTP_OK);
    }

    public function store(StoreRequest $request)
    {
        $dto = StoreDTO::fromRequest($request);
        $result = $this->storeService->execute($dto);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new ProductResource($result)], Response::HTTP_OK);
    }

    public function show($product_id)
    {
        $result = $this->showService->execute($product_id);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new ProductResource($result)], Response::HTTP_OK);
    }

    public function update(UpdateRequest $request, int $product_id)
    {
        $dto = UpdateDTO::fromRequest($request);
        $result = $this->updateService->execute($dto, $product_id);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new ProductResource($result)], Response::HTTP_OK);
    }

    public function destroy($product_id)
    {
        $this->destroyService->execute($product_id);
        return response()->json(['message' => 'Solicitud procesada con exito.'], Response::HTTP_OK);
    }
}
