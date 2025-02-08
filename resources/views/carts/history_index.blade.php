{{-- @extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-8">
      <h1>注文履歴・決済</h1>
      <div class="row g-3">
        @foreach ($carts as $cart)
          <div class="col-md-3 mb-3">
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">{{$cart->menu->name}}</h5>
                <p class="card-text">Price:{{$cart->menu->price}}JPY</p>
                <p class="card-text">Quantity:{{$cart->quantity}}</p>
                <p class="card-text">Request:{{$cart->request}}</p>
                <p class="">小計:{{$subTotal}}JPY</p>
              </div>
            </div>
          </div>
        @endforeach
        <p class="">OrderTotal:{{$orderTotal}}JPY</p>
      </div>

      <div class="d-flex justify-content-end mt-3"> 
          <a href="{{route('customer.menus.index')}}" class="btn border-dark text-dark mr-3">注文を続ける</a>
        @if ($orderTotal > 0)
        
        <a href="{{route('checkouts.index')}}"class="btn">支払いをする</a>
        @else
        <a href="{{route('checkouts.index')}}"class="btn disabled">支払いをする</a>
        @endif
      </div>
        
    </div> --}}