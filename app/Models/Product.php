<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'alias',
        'category_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $max_id =Product::withTrashed()->max('id')+1;
            $product->reg_no ='P' . Str::padLeft($max_id, 6, 0);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->select('id','name','alias','reg_no');
    }
}
