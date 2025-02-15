@extends('layouts.app')
@section('content')
  <div class="container mx-auto px-4 py-8">
    <h1>注文履歴・決済画面</h1>
    <div class="row g-3">
      @foreach ($carts as $cart)
        @if($cart->menu){{--menuが存在する場合--}}
          <div class="col-md-3 mb-3">
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">{{$cart->menu->name}}</h5>
                <p class="card-text">Price:{{$cart->menu->price}}JPY</p>
                <p class="card-text">Quantity:{{$cart->qty}}</p>
                <p class="card-text">Request:{{$cart->request}}</p>
                {{-- <a href="{{route('orders.edit',$cart->id)}}" class="btn btn-primary">Edit</a>
                <a href="{{route('orders.destroy',$cart->id)}}" class="btn btn-danger">Delete</a> --}}
                <p class="">小計:{{$subTotal}}JPY</p>
                <hr>
              </div>
            </div>
          </div>
        @endif
      @endforeach
      
      <p class="">OrderTotal:{{$orderTotal}}JPY</p>
    </div>

    <div class="d-flex justify-content-end mt-3"> 
      <form action="{{ route('checkouts.store') }}" method="POST">
        @csrf
        @if ($orderTotal > 0)
        <button type="submit" class="btn submit-button w-100">お支払い</a>
        @else
        <button type="submit" class="btn disabled">お支払い</a>
        @endif
      </form>
        <a href="{{route('customer.menus.index')}}" class="btn border-dark text-dark mr-3">戻る</a>
      {{-- @if ($orderTotal > 0) --}}
      
      {{-- <a href="{{route('checkouts.store')}}"class="btn">支払いする</a> --}}
      {{-- @else
      <a href="{{route('checkouts.store')}}"class="btn disabled">支払いする</a>
      @endif --}}
    </div>
      
  </div>
@endsection