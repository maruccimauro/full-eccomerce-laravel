<?php

namespace App\Http\Controllers;

use App\DTOs\Cart\StoreDTO;
use App\DTOs\Cart\UpdateDTO;
use App\Http\Requests\Cart\StoreRequest;
use App\Http\Requests\Cart\UpdateRequest;
use App\Http\Resources\Cart\CartResource;
use App\Services\Cart\DestroyService;
use App\Services\Cart\ListService;
use App\Services\Cart\ShowService;
use App\Services\Cart\StoreService;
use App\Services\Cart\UpdateService;
use Symfony\Component\HttpFoundation\Response;


class CartController extends Controller
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
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => CartResource::collection($result)], Response::HTTP_OK);
    }

    public function store(StoreRequest $request)
    {
        $dto = StoreDTO::fromRequest($request);
        $result = $this->storeService->execute($dto);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new CartResource($result)], Response::HTTP_OK);
    }

    public function show($cart_id)
    {
        $result = $this->showService->execute($cart_id);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new CartResource($result)], Response::HTTP_OK);
    }

    public function update(UpdateRequest $request, string $cart_id)
    {
        $dto = UpdateDTO::fromRequest($request);
        $result = $this->updateService->execute($dto, $cart_id);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new CartResource($result)], Response::HTTP_OK);
    }

    public function destroy($cart_id)
    {
        $this->destroyService->execute($cart_id);
        return response()->json(['message' => 'Solicitud procesada con exito.'], Response::HTTP_OK);
    }
}
