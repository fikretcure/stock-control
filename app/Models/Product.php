<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory , SoftDeletes;


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $max_id =Product::withTrashed()->max('id')+1;
            $product->reg_no ='P' . Str::padLeft($max_id, 6, 0);
        });
    }
}
