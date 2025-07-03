<?php

namespace App\Services\Address;

use App\DTOs\Address\StoreDTO;
use App\Models\Address;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreService
{
  public function execute(StoreDTO $dto)
  {

    if (Gate::denies('create', [Address::class, User::find($dto->user_id)])) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (Address::where('user_id', $dto->user_id)->count() >= 3) {
      throw new HttpResponseException(response()->json(['message' => 'Solo puedes tener un maximo de 3 direcciones al mismo tiempo.'], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    $duplicate = Address::where('user_id', Auth::id())
      ->where('line1', $dto->line1)
      ->where('postal_code', $dto->postal_code)
      ->exists();

    if ($duplicate) {
      throw new HttpResponseException(response()->json(['message' => 'Esta dirección ya fue registrada anteriormente.'], Response::HTTP_CONFLICT));
    }

    return Address::create($dto->toArray());
  }
}
