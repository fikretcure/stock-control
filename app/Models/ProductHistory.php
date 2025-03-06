<?php

namespace App\Models;

use App\Enums\ProductHistoryDescriptionEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductHistory extends Model
{
    use SoftDeletes;

    protected $appends = ['change_type_enum'];


    protected $fillable = [
        'product_id',
        'change',
        'before',
        'after',
        'action_at',
        'change_type',
        'note'
    ];


    protected $casts = [
        'action_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class)->select(['id', 'name','reg_no']);
    }


    public function product(){
        return $this->belongsTo(Product::class)->select(['id', 'name','reg_no']);
    }


    public function getChangeTypeEnumAttribute()
    {
       return ProductHistoryDescriptionEnum::from($this->change_type)->name;
    }
}
