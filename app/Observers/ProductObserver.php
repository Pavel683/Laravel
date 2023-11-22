<?php

namespace App\Observers;

use App\Mail\DeleteProductMail;
use App\Mail\RestoreProductMail;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class ProductObserver
{

    /**
     *
     * Уже готовый листнер со встроенными методами, как ресурс контроллер привязанный к конкретной модели
     *
     * Получается универсальный листнер который реагирует на все события с моделью
     *
     * Есть куча уже встроенных ивентов (Создание, удаление, восстановление, и эвенты срабатывающие ДО )
     *
     * Регистрируется в Providers\AppServiceProvider.php
     *
     */

    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {

    }

    public function deleting(Product $product){  // Событие ДО удаление, пока данные о продукте не исчезли
        $product_orders = $product->orders;
        $buyers_user_email = array();
        foreach ($product_orders as $product_order){
            if (!in_array($product_order->email, $buyers_user_email)) {
                Mail::to($product_order->email)->send(new DeleteProductMail($product_order));
                $buyers_user_email[] = $product_order->email;

            }
        }
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        $product_orders = $product->orders;
        $buyers_user_email = array();
        foreach ($product_orders as $product_order){
            if (!in_array($product_order->email, $buyers_user_email)) {
                Mail::to($product_order->email)->send(new RestoreProductMail($product_order));
                $buyers_user_email[] = $product_order->email;

            }
        }
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
