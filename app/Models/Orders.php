<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use SoftDeletes;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $keyType = 'string';
    protected $guarded = [];
    protected $casts = [
        'is_paid' => 'boolean'
    ];

    public function orderable() {
        return $this->morphTo(__FUNCTION__, 'order_type', 'order_id');
    }

    public function prepaid() {
        return $this->belongsTo(Prepaid::class, 'order_id', 'prepaid_id');
    }

    public function product() {
        return $this->belongsTo(Products::class, 'order_id', 'product_id');
    }
}
