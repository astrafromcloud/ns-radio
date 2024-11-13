<?php

namespace App\Http\Requests;

use App\Enums\RegisteredWithEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15|unique:users',
            'email' => 'required|string|email:dns|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'registered_with' => ['required', Rule::enum(RegisteredWithEnum::class)]
        ];
    }
}
