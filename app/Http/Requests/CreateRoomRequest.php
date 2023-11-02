<?php

namespace App\Http\Requests;

use App\Enums\RoomStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateRoomRequest extends FormRequest
{
    protected string $name;

    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->hasPermissionTo('create_room');
    }

    /**
     * @return array<string, array<Rule|string>>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('rooms')->where(function ($query) {
                    return $query->where('name', $this->name)
                        ->whereNot('status', RoomStatus::Finished);
                }),
            ],
        ];
    }
}
