<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'change' => $this->change,
            'before' => $this->before,
            'after' => $this->after,
            'product_id' => $this->product_id,
            'note' => $this->note,
            'supplier_id' => $this->supplier_id,
            'supplier_reg_no' => $this->supplier_reg_no,
            'change_type' => $this->change_type,
            'change_type_enum' => $this->change_type_enum,
            'supplier' => $this->supplier,
            'product' => $this->product,

            'action_at' => $this->action_at->toIso8601String(),
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
            'deleted_at' => $this->deleted_at?->toIso8601String(),
        ];
    }
}
