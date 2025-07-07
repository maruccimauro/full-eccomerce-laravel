<?php

namespace App\Http\Controllers;

use App\DTOs\Category\StoreDTO;
use App\DTOs\Category\UpdateDTO;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Services\Category\DestroyService;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Category\ListService;
use App\Services\Category\StoreService;
use App\Services\Category\ShowService;
use App\Services\Category\UpdateService;

class CategoryController extends Controller
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
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => CategoryResource::collection($result)], Response::HTTP_OK);
    }

    public function store(StoreRequest $request)
    {
        $dto = StoreDTO::fromRequest($request);
        $result = $this->storeService->execute($dto);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new CategoryResource($result)], Response::HTTP_OK);
    }

    public function show($category_id)
    {
        $result = $this->showService->execute($category_id);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new CategoryResource($result)], Response::HTTP_OK);
    }

    public function update(UpdateRequest $request, $category_id)
    {
        $dto = UpdateDTO::fromRequest($request);
        $result = $this->updateService->execute($dto, $category_id);
        return response()->json(['message' => 'Solicitud procesada con exito.', 'data' => new CategoryResource($result)], Response::HTTP_OK);
    }

    public function destroy($category_id)
    {
        $this->destroyService->execute($category_id);
        return response()->json(['message' => 'Solicitud procesada con existo'], Response::HTTP_OK);
    }
}
