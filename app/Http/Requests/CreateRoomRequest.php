<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CreateRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->hasPermissionTo('create_room');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:rooms,name|string|max:255',
        ];
    }
}
