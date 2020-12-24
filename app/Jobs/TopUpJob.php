<?php

namespace App\Jobs;

use App\Models\Prepaid;
use App\Repository\OrderRepository;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TopUpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $prepaid;

    public function __construct(Prepaid $prepaid)
    {
        $this->prepaid = $prepaid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(OrderRepository $orderRepository)
    {
        $now = Carbon::now();
        $start = Carbon::createFromTimeString('09:00');
        $end = Carbon::createFromTimeString('17:00');

        $rand = mt_rand(1, 100);

        if ($now->between($start, $end)) {
            if ( 90 >= $rand ) {
                $orderRepository->create($this->prepaid, Prepaid::class, true);
            } else {
                $orderRepository->create($this->prepaid, Prepaid::class, false);
            }
        } else {
            if ( 40 >= $rand ) {
                $orderRepository->create($this->prepaid, Prepaid::class, true);
            } else {
                $orderRepository->create($this->prepaid, Prepaid::class, false);
            }
        }

    }
}
