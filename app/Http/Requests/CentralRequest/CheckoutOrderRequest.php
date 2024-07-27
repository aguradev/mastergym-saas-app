<?php

namespace App\Http\Requests\CentralRequest;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutOrderRequest extends FormRequest
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
            "full_name" => "required",
            "email" => ["required", "unique:tenant_transactions,email"],
            "phone_number" => "required|numeric",
            "address" => "required",
        ];
    }
}
