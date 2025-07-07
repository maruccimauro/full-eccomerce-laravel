<?php

namespace App\Http\Controllers;

use App\Services\CartItem\DestroyService;
use App\Services\CartItem\ListService;
use App\Services\CartItem\ShowService;
use App\Services\CartItem\StoreService;
use App\Services\CartItem\UpdateService;
use App\DTOs\CartItem\StoreDTO;
use App\DTOs\CartItem\UpdateDTO;
use App\Http\Requests\CartItem\StoreRequest;
use App\Http\Requests\CartItem\UpdateRequest;
use App\Http\Resources\CartItem\CartItemResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class CartItemController extends Controller
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
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => CartItemResource::collection($result)], Response::HTTP_OK);
    }

    public function store(StoreRequest $request)
    {
        $dto = StoreDTO::fromRequest($request);
        $result = $this->storeService->execute($dto);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new CartItemResource($result)], Response::HTTP_OK);
    }

    public function show($category_id)
    {
        $result = $this->showService->execute($category_id);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new CartItemResource($result)], Response::HTTP_OK);
    }

    public function update(UpdateRequest $request, $cartItem_id)
    {
        $dto = UpdateDTO::fromRequest($request);
        $result = $this->updateService->execute($dto, $cartItem_id);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new CartItemResource($result)], Response::HTTP_OK);
    }

    public function destroy($category_id)
    {
        $this->destroyService->execute($category_id);
        return response()->json(['message' => 'Solicitud procesada con existo'], Response::HTTP_OK);
    }
}
