<?php

namespace App\Http\Controllers;

use App\DTOs\Order\StoreDTO;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Resources\Order\OrderResource;
use App\Services\Order\ListService;
use App\Services\Order\ShowWithOrderItemsService;
use App\Services\Order\StoreService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Order\WithOrderItemsResource;


class OrderController extends Controller
{

    public function __construct(
        private ListService $listService,
        private StoreService $storeService,
        private ShowWithOrderItemsService $showWithOrderItemsService,

    ) {}
    public function index()
    {
        $result = $this->listService->execute();
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => OrderResource::collection($result)], Response::HTTP_OK);
    }

    public function store(StoreRequest $request)
    {
        $dto = StoreDTO::fromRequest($request);
        $result = $this->storeService->execute($dto);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new OrderResource($result)], Response::HTTP_OK);
    }

    public function showWithOrderItems($order_id)
    {
        $result = $this->showWithOrderItemsService->execute($order_id);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new WithOrderItemsResource($result)], Response::HTTP_OK);
    }
}
