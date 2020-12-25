<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $keyType = 'string';
    protected $guarded = [];

    public $incrementing = false;

    public function order() {
        return $this->morphOne(Orders::class, 'order');
    }
}
