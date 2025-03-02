<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory , SoftDeletes;


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $lastProduct = Product::withTrashed()->latest('id')->first();
            $product->reg_no = rand();
        });
    }
}
