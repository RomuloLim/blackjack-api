<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function store(StoreUserRequest $request): JsonResource
    {
        $data = $request->validated();

        $user = User::create($data);

        $user->sendEmailVerificationNotification();

        return new UserResource($user);
    }
}
