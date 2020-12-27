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

    public function getClass() {
        return Products::class;
    }

    public function order() {
        return $this->morphOne(Orders::class, 'order');
    }

    public function findWhere($productId, User $user)
    {
        return $this->where(['product_id' => $productId, 'user_id' => $user->id]);
    }

    public function getPriceAttribute($value)
    {
        return $value + 10000;
    }
}
