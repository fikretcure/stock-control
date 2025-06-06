<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([CategoryObserver::class])]
class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, SoftDeletes;

    protected $appends = ['all_parents'];

    protected $fillable = [
        'name',
        'category_id',
        'alias'
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $max_id = Category::withTrashed()->max('id') + 1;
            $product->reg_no = 'C' . Str::padLeft($max_id, 6, 0);
        });
    }

    public function childiren()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function getAllParentsAttribute()
    {
        $categories = [];
        $category = $this;

        while ($category->category_id) {
            $category = Category::find($category->category_id);
            if ($category) {
                $categories[] = $category->name;
            } else {
                break;
            }
        }

        return empty($categories) ? null : implode(' > ', array_reverse($categories));
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id')->select('id', 'name', 'reg_no');
    }


    public function getAllChildrenIds()
    {
        $ids = $this->childiren()->pluck('id')->toArray();

        foreach ($this->childiren as $child) {
            $ids = array_merge($ids, $child->getAllChildrenIds());
        }

        return $ids;
    }
}
