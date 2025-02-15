@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mt-3">
      <div class="w-75">
          <h1 class="">カート(注文は完了していません)</h1>
    
          {{-- <div class="row">
              <div class="offset-8 col-4">
                  <div class="row">
                      <div class="col-6">
                        <h2>数量</h2>
                      </div>
                      <div class="col-6">
                        <h2>合計</h2>
                      </div>
                  </div>
              </div>
          </div> --}}
    
          <hr>

          <div class="row g-3 d-flex">
            @foreach($cart as $menu)
              <div class="col-md2 mt-2">
                
                <a href="{{route('customer.menus.show',$menu->id)}}">
                  <div class="mb-2">
                    {{-- 画像表示は未実装。あとで再度確認 --}}
                    {{-- @if ($menu->image !== '')
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="Menu Image" class="w-100">
                    @else
                        <img src="{{ asset('/images/no_image.jpg') }}" class="w-100">
                    @endif --}}
                    {{-- 画像を表示する --}}
                    {{-- @if (!empty($item->options->image))
                      <img src="{{ asset('storage/' . $item->options->image) }}" alt="商品画像" class="w-100">
                    @else
                      <img src="{{ asset('/images/no_image.jpg') }}" class="w-100">
                    @endif --}}
                  </div>
                </a>
              </div>
              <div class="col-md-6 mt-4">
                <h3 class="mt-4">{{$menu->name}}</h3>
              </div>
              <div class="col-md-2">
                <h3 class="w-100 mt-4">¥{{$menu->price}}/pcs</h3>
              </div>  
              <div class="col-md-2">
                <h3 class="w-100 mt-4">注文数：{{$menu->qty}}pcs</h3>
              </div>
              <div class="col-md-2">
                <h3 class="w-100 mt-4">¥{{$menu->qty * $menu->price}}</h3>
              </div>
              {{-- 編集、削除ボタン未実装。あとで見直す --}}
              {{-- <div>
                <a href="{{ route('carts.edit', $menu->id) }}" class="btn btn-primary">編集</a>
                <form action="{{ route('carts.destroy', $menu->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">削除</button>
                </form> --}}
              
                {{-- <a href="{{ route('carts.edit', $menu->id) }}" class="btn btn-primary">Edit</a> --}}
                {{-- <a href="{{ route('carts.destroy', $menu->id) }}" class="btn btn-danger">Delete</a> --}}
              {{-- </div> --}}
            <hr>
              {{-- <p>小計JPY{{$subTotal}}</p> --}}
            @endforeach
          </div>
    
          <hr>
    
          <div class="offset-8 col-4">
            <div class="row">
                {{-- <div class="col-6">
                    <h2>小計:JPY{{$subTotal}}</h2>
                </div> --}}
                {{-- <div class="col-6">
                    <h2>JPY{{$total}}</h2>
                </div> --}}
                {{-- <div class="col-12 d-flex justify-content-end">
                    表示価格は税込みです
                </div> --}}
                
            </div>
          </div>

          <div class="d-flex justify-content-end mt-3"> 
            {{-- <form action="{{route('carts.success')}}"method="POST">
              
            </form> --}}
            {{-- <a href="{{route('carts.edit',$cart->id)}}" class="btn btn-primary">Edit</a>
            <a href="{{route('carts.destroy',$cart->id)}}" class="btn btn-danger">Delete</a> --}}
            <p class="">合計:{{$total}}JPY(税込)</p>
            <a href="{{route('customer.menus.index')}}" class="btn border-dark text-dark mr-3">他のメニューを探す</a>
            @if ($total > 0)

              <form action="{{ route('carts.success') }}" method="POST">
                  @csrf
                <button type="submit" class="btn submit-button w-100">注文送信</button>
                {{-- <a href="{{route('carts.success')}}"class="btn btn-primary">注文送信</a> --}}
              </form>  
                @else
                  <a href="{{route('carts.success')}}"class="btn disabled">注文送信</a>
                @endif
              

          </div>
        </div> 
    </div>

@endsection          