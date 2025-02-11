@extends('layouts.app')
@section('content')
<div class="col container">
  <div class="row justify-content-center">
      <div class="col-xxl-9 col-xl-10 col-lg-11">
          <div class="row row-cols-md-3 row-cols-2 g-3 mb-5">
              <div class="col">
                  <div class="card bg-light">
                      <div class="card-body text-center">
                          <h5 class="card-title">
                            <a href="{{route('admin.menus.create')}}"class="btn btn-primary">新規メニュー登録</a>
                          </h5>
                          {{-- <p class="card-text">{{ $total_users }}名</p> --}}
                      </div>
                  </div>
              </div>
              <div class="col">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                          <a href="{{route('admin.menus.index')}}"class="btn btn-primary">メニュー編集</a>
                        </h5>
                        {{-- <p class="card-text">{{ $total_users }}名</p> --}}
                    </div>
                </div>
            </div>
              <div class="col">
                  <div class="card bg-light">
                      <div class="card-body text-center">
                        <h5 class="card-title">
                          <a href="{{route('admin.orders.index')}}"class="btn btn-primary">注文オーダー</a>
                        </h5>
                          {{-- <h5 class="card-title">注文オーダー</h5> --}}
                          {{-- <p class="card-text">{{ $total_free_users }}名</p> --}}
                      </div>
                  </div>
              </div>
              {{-- {{-- <div class="col">
                  <div class="card bg-light">
                      <div class="card-body text-center">
                          <h5 class="card-title">有料会員数</h5>
                          <p class="card-text">{{ $total_premium_users }}名</p>
                      </div>
                  </div>
              </div> --}}
              <div class="col">
                  <div class="card bg-light">
                      <div class="card-body text-center">
                          <h5 class="card-title">
                            <a href="{{route('admin.menus.index')}}">在庫数</a>
                          </h5>
                          {{-- <p class="card-text">{{ $total_restaurants }}件</p> --}}
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card bg-light">
                      <div class="card-body text-center">
                          <h5 class="card-title">当日売上高</h5>
                          {{-- <p class="card-text">{{ $total_reservations }}件</p> --}}
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card bg-light">
                      <div class="card-body text-center">
                          <h5 class="card-title">月間売上</h5>
                          {{-- <p class="card-text">{{ number_format($sales_for_this_month) }}円</p> --}}
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
