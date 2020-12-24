<?php

namespace App\Http\Controllers;

use App\enum\Value;
use App\Http\request\PrepaidRequest;
use App\Jobs\TopUpJob;
use App\Models\Prepaid;
use App\Repository\PrepaidRepository;
use Illuminate\Http\Request;

class PrepaidController extends Controller
{
    public function index(PrepaidRepository $prepaidRepository)
    {
        $me = auth()->user();
        $counter = $prepaidRepository->getUnpaidOrder($me);
        return view('prepaid', [
            'me' => $me,
            'counter' => $counter,
            'values' => Value::getValues()
        ]);
    }

    public function process(PrepaidRequest $prepaidRequest, PrepaidRepository $prepaidRepository)
    {
        $me = auth()->user();
        $validated = $prepaidRequest->validated();
        $prepaid = $prepaidRepository->topUp($validated, $me->id);
        TopUpJob::dispatch($prepaid);
        return redirect('/prepaid/result/' . $prepaid->prepaid_id);
    }

    public function result(Prepaid $prepaid, PrepaidRepository $prepaidRepository)
    {
        $me = auth()->user();
        $counter = $prepaidRepository->getUnpaidOrder($me);
        $order = $prepaid->order;
        return view('result', [
            'me' => $me,
            'counter' => $counter,
            'prepaid' => $prepaid,
            'title' => $order->is_success ? "Success" : "Failed",
            'order_number' => $order->order_id,
            'total' => $prepaid->value + ((5 * $prepaid->value) / 100),
            'date' => $prepaid->created_at
        ]);
    }
}
