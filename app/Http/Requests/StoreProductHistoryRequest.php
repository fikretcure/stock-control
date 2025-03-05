<?php

namespace App\Http\Requests;

use App\Enums\ProductHistoryDescriptionEnum;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreProductHistoryRequest extends FormRequest
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
            'supplier_id' => [
                'nullable',
                Rule::unique('suppliers', 'id')
            ],
            'supplier_reg_no' => [
                'nullable',
                'string',
            ],
            'change' => [
                'required',
                'integer',
            ],
            'change_type' =>  [
                'required',
                new Enum(ProductHistoryDescriptionEnum::class),
            ],
            'action_at' => [
                'required',
                Rule::date()->format('Y-m-d H:i'),
                'before_or_equal:now',
                'after_or_equal:' . Carbon::now()->subMonth()->format('Y-m-d H:i'),
            ]
        ];
    }
}
