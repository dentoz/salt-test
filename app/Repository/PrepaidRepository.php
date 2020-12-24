<?php

namespace App\Repository;

use App\Models\Prepaid;
use App\Models\User;
use Illuminate\Support\Str;

class PrepaidRepository
{
    public function getUnpaidOrder(User $user)
    {
        $prepaid = Prepaid::where('user_id', $user->id)->first();
        return $prepaid->order->where('is_paid', 0)->count();
    }

    public function topUp($input, $userId)
    {
        $model = new Prepaid();
        $model->prepaid_id = Str::orderedUuid()->toString();
        $model->phone_number = $input['phone'];
        $model->value = $input['value'];
        $model->user_id = $userId;
        $model->save();
        return $model;
    }
}
