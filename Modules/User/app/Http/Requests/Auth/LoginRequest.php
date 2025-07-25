<?php

namespace Modules\User\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\DTOs\LoginDTO;

class LoginRequest extends FormRequest
{
    public LoginDTO $loginData;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'emailOrUsername'   => 'required|string|min:8',
            'password'          => 'required|string|min:8',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function passedValidation(): void
    {
        $this->loginData = LoginDTO::from($this->validated());
    }
}
