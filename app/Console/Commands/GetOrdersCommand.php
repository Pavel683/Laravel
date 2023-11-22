<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class GetOrdersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::all();
        $header = ['Product Name', 'Price', 'Buyer', 'Telephone'];
        $table_data = array();
        foreach ($orders as $order){
            $order_data = array();
            $order_data[] = $order->product()->withTrashed()->first()->product_name;
            $order_data[] = $order->product()->withTrashed()->first()->price;
            $order_data[] = $order->user->fio;
            $order_data[] = $order->telephone;
            $table_data[] = $order_data;

        }
//        dd($table_data);


        $this->table($header, $table_data);
    }
}
