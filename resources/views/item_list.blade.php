<h4>{{ $product->product_name . ' | Цена: ' . $product->price . ' руб' }}</h4><a class="btn btn-info" href="{{ route('orders.create', compact('product')) }}">Заказать</a><br><hr>
