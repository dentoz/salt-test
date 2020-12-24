<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use SoftDeletes;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];
    protected $casts = [
        'is_paid' => 'boolean'
    ];

    public function orderable() {
        return $this->morphTo(__FUNCTION__, 'order_type', 'order_id');
    }
}
