<?php

namespace App\Listeners;

use App\Mail\DeleteProductMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ProductListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $product = $event->product;
        $product_orders = $product->orders;
        $buyers_user_email = array();
        foreach ($product_orders as $product_order){
            if (!in_array($product_order->email, $buyers_user_email)) {
                Mail::to($product_order->email)->send(new DeleteProductMail($product_order));
                $buyers_user_email[] = $product_order->email;

            }
        }
//        dd($buyers_user_email);
    }
}
