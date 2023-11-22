<?php

namespace App\Jobs;

use App\Mail\CreateOrdersMail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailsJob implements ShouldQueue
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
    public function handle(): void
    {
        Mail::to($this->order->email)->send(new CreateOrdersMail($this->order));
    }

    public function failed(){  // Если произошла какая нибудь ошибка
        Log::channel('mails')->critical("Ошибка: Сообщение на заказ " . $this->order->id . " не отправилось");
    }

}
