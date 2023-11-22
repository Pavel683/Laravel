<?php

namespace App\Http\Controllers;

use App\Events\ProductEvent;
use App\Events\ProductRestoreALLEvent;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

//        Cache::put('key', 'cache', 5); // Кешируем какие либо данные на 5 мин
//        if (Cache::has('key')){
//            $cache_val = Cache::get('key', 'default'); // Получить данные кеша по ключу, есть ще метод has позволяющий проверять, есть ли?
//            dump($cache_val);
//        }else{
//            dump('No');
//        }


//        $products_cached = Cache::rememberForever('products_cache', function (){  // Сохраняем список продуктов в кэш
////            return Product::all();                                              // Если после сохранения это убрать, то в кеше все равно останется
//        });
//        dump($products_cached);

        $products = Product::paginate(5);  // Пагинация (постраничная новигация)
        return view('product_list', compact('products'));
    }

     public function product_admin()
    {
        $products = Product::paginate(5);
        $delete_products = Product::onlyTrashed()->get();
        return view('admin.product_admin', compact('products', 'delete_products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = [
            'product_name' => $request->product_name,
            'price' => $request->price
        ];
        Product::create($data);
        session()->flash('success', 'Товар добавлен!');  // Добавить временные поля в сессию до следующего обновления/действия
        return redirect(route('product_admin'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
//        event(new ProductEvent($product)); // Евент который при активации будет вызывать листнеры и передавать объект
        Log::channel('product_deleted')->notice(json_decode(json_encode($product), true)); // Свой канал логов, в свой файл
        $product->delete();  // forceDelete()  полное удаление
        session()->flash('destroy', 'Товар удален'); // Добавить временные поля в сессию до следующего обновления/действия
        return redirect()->back();
    }

    public function restore($product_id){
        Product::withTrashed()->find($product_id)->restore(); // Метод позволяющий восстанивить запись
        session()->flash('success', 'Товар восстановлен');
        return redirect()->back();
    }

    public function restore_all(){

        $products = Product::onlyTrashed()->get(); // получаем все удаленные
        foreach ($products as $product){
            event(new ProductRestoreALLEvent($product));
        }

        Product::withTrashed()->restore(); // Метод позволяющий восстанивить запись
        session()->flash('success', 'Товары восстановлены');
        return redirect()->back();
    }

}
