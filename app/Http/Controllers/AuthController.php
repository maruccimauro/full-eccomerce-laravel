<?php

namespace App\Http\Controllers;

use App\DTOs\Auth\LoginUserDTO;
use App\DTOs\Auth\RegisterUserDTO;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\RegisterUserService;
use App\Services\Auth\LoginUserService;



class AuthController extends Controller
{
    public function __construct(private RegisterUserService $registerUserService, private LoginUserService $loginUserService) {}

    public function register(RegisterRequest $request)
    {
        try {
            $dto = RegisterUserDTO::fromRequest($request);
            $result = $this->registerUserService->execute($dto);
            return response()->json([
                'message' => 'El usuario fue creado con exito',
                'usuario' => $result['user'],
                'token' => $result['token']
            ], Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            Log::error('Error en registro de usuario : ' . $e->getMessage());
            return response()->json(['message' => 'Error al crear el usuario.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function login(LoginRequest $request)
    {
        $dto = LoginUserDTO::fromRequest($request);
        $result = $this->loginUserService->execute($dto);
        return response()->json(
            [
                'message' => 'La autenticacion fue realizada con exito',
                'data' => $result['user'],
                'token' => $result['token']
            ],
            Response::HTTP_OK
        );
    }
}
