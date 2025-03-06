<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $request->id,
            'name' => $request->name,
            'alias' => $request->alias,
            'reg_no' => $request->reg_no,
            'parent' => $request->parent,
            'all_parents' => $request->all_parents,
            'created_at' => $request->created_at,
            'deleted_at' => $request->deleted_at,
        ];
    }
}
