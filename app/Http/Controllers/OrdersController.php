<?php

namespace App\Http\Controllers;

use App\Jobs\EmailsJob;
use App\Jobs\OrdersJob;
use App\Mail\CreateOrdersMail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(5);
        return view('admin.orders_list', compact('orders'));
    }

    public function json_list(){
        return Order::all()->toJson(); // toArray()
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->query('product')){
            $product_id = $request->query('product');
        }
        $seller = Auth::user();
        $product = Product::find($product_id);

        return view('order_send', compact('seller', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'telephone' => ['required', 'max:255'],
        ]);

        $data = [
            'seller_id' => $request->seller_id,
            'product_id' => $request->product_id,
            'telephone' => $request->telephone,
            'email' => $request->email
        ];
        $order = Order::create($data);
        Log::info($order);  // Логирование
        OrdersJob::dispatch($order); // Очередь


//        EmailsJob::dispatch($order)->onQueue('emails'); // Отдельная очередь для емейлов

        Mail::to($request->email)->queue((new CreateOrdersMail($order))->onQueue('emails')); // Для емаилов можно проще задать очередь

//        Mail::to($request->email)->send(new CreateOrdersMail($order));

        session()->flash('success', 'Заказ сделан!');  // Добавить временные поля в сессию до следующего обновления/действия
        return redirect(route('product_list'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
