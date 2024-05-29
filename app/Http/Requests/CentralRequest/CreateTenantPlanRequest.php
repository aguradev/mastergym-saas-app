<?php

namespace App\Http\Requests\CentralRequest;

use Illuminate\Foundation\Http\FormRequest;

class CreateTenantPlanRequest extends FormRequest
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
            "title" => ["required", "unique:tenant_subscription_plan,name"],
            "price_per_month" => ["required", "numeric"],
            "price_per_year" => ["required", "numeric"],
            "features" => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            "features" => [
                "required" => "features is required"
            ],
            "title" => [
                "required" => "Title is required",
                "unique" => "Title has been exists"
            ],
            "price_per_month" => [
                "required" => "Price per month is required"
            ],
            "price_per_year" => [
                "required" => "Price per year is required"
            ]
        ];
    }
}
