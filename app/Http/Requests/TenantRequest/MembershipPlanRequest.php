<?php

namespace App\Http\Requests\TenantRequest;

use Illuminate\Foundation\Http\FormRequest;

class MembershipPlanRequest extends FormRequest
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
        $validationRules = [
            "title" => "required|unique:membership_plans,title",
            "period_type" => "required",
            "amount" => "numeric",
            "features" => "required"
        ];

        $paramData = $this->route()->parameter("membershipPlan");

        if (!is_null($paramData)) {
            $validationRules['title'] = 'required|unique:membership_plans,title,' . $paramData->id;
        }

        return $validationRules;
    }
}