<?php

namespace App\Http\Requests\TenantRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserCredentialRequest extends FormRequest
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
            "profileImg" => ["image", "max:1024"],
            "username" => ["required", "unique:tenant_credentials,username"],
            "role" => ["required"],
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|unique:tenant_credentials,email",
            "phone_number" => "required|numeric",
            "password" => ["required", "confirmed", Password::min(8)],
            "password_confirmation" => "required"
        ];
    }
}
