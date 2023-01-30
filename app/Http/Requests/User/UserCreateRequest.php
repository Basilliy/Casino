<?php

namespace App\Http\Requests\User;

use App\Interfaces\Requests\User\UserCreateInterface;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property string user_name
 * @property string phone_number
 */
class UserCreateRequest extends FormRequest implements UserCreateInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(
        [
            'user_name' => "array",
            'phone_number' => "array"
        ]
    )]
    public function rules(): array
    {
        return [
            'user_name' => ['required'],
            'phone_number' => ['required', 'numeric', 'digits:10'],
        ];
    }

    public function getUserName(): string
    {
        return $this->user_name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }
}
