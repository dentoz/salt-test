<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prepaid extends Model
{
    use SoftDeletes;

    protected $table = 'prepaid';
    protected $primaryKey = 'prepaid_id';
    protected $keyType = 'string';
    protected $guarded = [];

    public $incrementing = false;

    public function getClass() {
        return Prepaid::class;
    }

    public function order() {
        return $this->morphOne(Orders::class, 'order');
    }

    public function findWhere($prepaidId, User $user)
    {
        return $this->where(['prepaid_id' => $prepaidId, 'user_id' => $user->id]);
    }
}
