<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory , SoftDeletes;


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $max_id =Supplier::withTrashed()->max('id')+1;
            $product->reg_no ='S' . Str::padLeft($max_id, 6, 0);
        });
    }
}
