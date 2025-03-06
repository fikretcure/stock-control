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

    public function supplier(){
        return $this->belongsTo(Supplier::class)->select(['id', 'name','reg_no']);
    }

    public function getChangeTypeEnumAttribute()
    {
       return ProductHistoryDescriptionEnum::from($this->change_type)->name;
    }
}
