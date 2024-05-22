<?php

namespace App\Http\Requests\CentralRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditFeaturePlanRequest extends FormRequest
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
            'input_feature' => ["required", "min:6", "unique:tenant_plan_features,name," . request()->id]
        ];
    }

    public function messages(): array
    {
        return [
            'input_feature.required' => 'Feature input required!',
            'input_feature.min' => 'Minimum 6 word!',
            'input_feature.unique' => 'Feature plan already exists!'
        ];
    }
}
