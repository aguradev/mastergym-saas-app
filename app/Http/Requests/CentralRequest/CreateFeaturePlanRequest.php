<?php

namespace App\Http\Requests\CentralRequest;

use Illuminate\Foundation\Http\FormRequest;

class CreateFeaturePlanRequest extends FormRequest
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
            'items.*.input_feature' => "required|string|min:6|unique:tenant_plan_features,name"
        ];
    }

    public function messages(): array
    {
        return [
            'items.*.input_feature.required' => 'Feature input required!',
            'items.*.input_feature.min' => 'Minimum 6 word!',
            'items.*.input_feature.unique' => 'Feature plan already exists!'
        ];
    }
}
