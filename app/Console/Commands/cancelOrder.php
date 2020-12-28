<?php

namespace App\Console\Commands;

use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Console\Command;

class cancelOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Canceling order';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Orders::where('is_paid', 0)->where('created_at', '<', Carbon::now()->subMinutes(5)->toDateTimeString())->delete();
    }
}
