<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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

        $not_id = $this->category->getAllChildrenIds();
        $not_id[] = $this->category->id;

        return [
            'name' => [
                'required',
                'string',
                Rule::unique('categories')->ignore($this->category),
            ],
            'category_id'=>[
                'nullable',
                Rule::exists('categories','id'),
                Rule::notIn($not_id)
            ],
            'alias' => [
                'nullable',
                'string',
                 Rule::unique('categories')->ignore($this->category),
            ]
        ];
    }
}
