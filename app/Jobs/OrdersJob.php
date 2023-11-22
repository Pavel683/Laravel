<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OrdersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $order;

    public function __construct(  // Объект для обработки
        Order $order
    )
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void  // Действия в очереди
    {
        Log::channel('new_order')->alert('Новый заказ: ' . $this->order->product->product_name . " От " . $this->order->user->fio . " на сумму: " .  $this->order->product->price);
    }
}
