<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductHistory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'change',
        'before',
        'after',
        'action_at',
        'change_type',
        'note'
    ];
}
