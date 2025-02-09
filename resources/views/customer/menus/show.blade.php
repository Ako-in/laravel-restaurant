@extends('layouts.app')
@section('content')
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-align-center">{{$menu->name}}の詳細ページ</h1>
    <hr>

    <div class="mb-2">
      @if ($menu->image !== '')
          <img src="{{ asset('storage/' . $menu->image) }}" alt="Menu Image" class="w-100">
      @else
          <img src="{{ asset('/images/no_image.jpg') }}" class="w-100">
      @endif

      <p class="">{{$menu->name}}</p>
      <p class="">{{$menu->price}}JPY(tax include)</p>
      
      <p class="">{{$menu->description}}</p>
      <small>Available stock: {{ $menu->stock }}</small>
      <hr>
    </div>
    
    <form method="POST" action="{{route('carts.add')}}"class="m-3 align-items-end">
      @csrf
      <div class="">
        @if ($menu->stock > 0)
          <div class="mb-3">
            {{-- <label for="quantity" class="form-label">QTY(pcs):</label> --}}
              <input type="hidden" name="id" value="{{$menu->id}}">
              <input type="hidden" name="name"value="{{$menu->name}}">
              <input type="hidden" name="price"value="{{$menu->price}}">
              <input type="hidden" name="image" value="{{ $menu->image ?? '' }}">
              <input type="number" name="qty" value="1" min="1">
              {{-- <input type="number" name="qty" value="1" min="1"> --}}
              {{-- <input type="hidden" name="image"value="{{$menu->image}}"> --}}
              {{-- <input type="hidden" name="quantity" value="{{ $cart ? $cart->quantity : 1 }}"> --}}
              {{-- <input type="hidden" name="request" value="{{ $cart ? $cart->request : '' }}"> --}}
              {{-- <small>Available stock: {{ $menu->stock }}</small> --}}
          </div>
            {{-- リクエストは一旦保留のためコメントアウト --}}
            {{-- <p class="">Any request</p>
            <input class="flex"type="text" id="request"></input> --}}
            {{-- <button type="submit" class="btn btn-primary">カートに追加する</button> --}}
        @else
            <p class="text-danger">Out of stock</p>
        @endif
      </div>
      {{-- <div class="form-group row">
        <label for="quantity" class="col-sm-2 col-form-label">数量</label>
        <div class="col-sm-10">
          <input type="number"id="quantity"name="qty"min="1"value="1"class="form-control w-25">
        </div>
      </div> --}}
      {{-- <input type="hidden" name="weight"value="0"> --}}
      <div class="row">
        <div class="col-7">
          <button type="submit" class="btn submit-button w-100" onclick="console.log('送信ボタンがクリックされました')">
            カートに追加
          </button>

        </div>
      </div>
    </form>

    <hr>
   
    <a href="{{ route('customer.menus.index') }}" class="btn btn-secondary">Back</a>
@endsection
    
