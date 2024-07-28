<?php

namespace App\Http\Requests\CentralRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class TenantTransactionRegistration extends FormRequest
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
            "gym_title" => ["required", "unique:tenants,name"],
            "domain" => ["required", "lowercase", "unique:domains,domain"],
            "gym_email" => ["required", "email", "unique:tenants,email"],
            "address" => ["required", "min:10"],
            "first_name" => ["required"],
            "last_name" => ["required"],
            "user_email" => ["required", "email"],
            "password" => ["required", "confirmed", Password::min(8)],
            "password_confirmation" => ["required"]
        ];
    }
}
