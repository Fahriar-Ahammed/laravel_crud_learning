<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CreateUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Exception;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        try {
            $users = $this->userService->getAllUsers();
            return response()->json(['data' => $users], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->createUser($request);
            return response()->json(['data' => $user, 'message' => 'User created successfully'], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $user = $this->userService->getUserById($id);
            return response()->json(['data' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        try {
            $user = $this->userService->updateUser($request, $id);
            return response()->json(['data' => $user, 'message' => 'User updated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->userService->deleteUser($id);
            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }
}
