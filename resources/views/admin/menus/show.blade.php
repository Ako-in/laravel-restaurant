@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-align-center">Menu Details</h1>
    <hr>
    
    <div class="row mt-5 pb-2">
        
        <div class="col-md-3">
            <span class="fw-bold">ID:</span>
        </div>
        <div class="col-md-3">
            <span>{{ $menu->id }}</span>
        </div>
    </div>
    <div class="row pb-2 mb-2 border-bottom">
        <div class="col-2">
            <span class="fw-bold">Name:</span>
        </div>
        <div class="col">
            <span>{{ $menu->name }}</span>
        </div>
    </div>
    <div class="row pb-2 mb-2 border-bottom">
        <div class="col-2">
            <span class="fw-bold">Category:</span>
        </div>
        <div class="col">
            <span>{{ optional($menu->category)->name ?? 'N/A' }}</span>
        </div>
    </div>

    <div class="row pb-2 mb-2 border-bottom">
        <div class="col-2">
            <span class="fw-bold">Description:</span>
        </div>
        <div class="col">
            <span>{{ $menu->description }}</span>
        </div>
    </div>

    <div class="row pb-2 mb-2 border-bottom">
        <div class="col-2">
            <span class="fw-bold">Price:</span>
        </div>
        <div class="col">
            <span>{{ $menu->price }}</span>
        </div>
    </div>

    <div class="row pb-2 mb-2 border-bottom">
        <div class="col-2">
            <span class="fw-bold">Stock:</span>
        </div>
        <div class="col">
            <span>{{ $menu->stock }}</span>
        </div>
    </div>

    <div class="mb-2">
        @if ($menu->image !== '')
            <img src="{{ asset('storage/' . $menu->image) }}" alt="Menu Image" class="w-100">
        @else
            <img src="{{ asset('/images/no_image.jpg') }}" class="w-100">
        @endif
    </div>

    <div class="row pb-2 mb-2 border-bottom">
        <div class="col-2">
            <span class="fw-bold">Status:</span>
        </div>
        <div class="col">
            <span>{{ $menu->status ? 'Active' : 'Inactive' }}</span>
        </div>
    </div>
    <div class="row pb-2 mb-2 border-bottom">
        <div class="col-2">
            <span class="fw-bold">Created At:</span>
        </div>
        <div class="col">
            <span>{{ $menu->created_at }}</span>
        </div>
    </div>
    <hr>
    
    <tr>
      <td>
        <a href="{{ route('admin.menus.index') }}" class="btn btn-primary">>Back</a>
      </td>
      <td>
        <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-primary">Edit</a>
      </td>
    </tr>


    
    {{-- <p><strong>Name:</strong> {{ $menu->name }}</p>
    <p><strong>Category:</strong> {{ optional($menu->category)->name ?? 'N/A' }}</p>
    <p><strong>Price:</strong> {{ $menu->price }}</p>
    <p><strong>Description:</strong> {{ $menu->description }}</p>
    <p><strong>Stock:</strong> {{ $menu->stock }}</p>
    <p><strong>Status:</strong> {{ $menu->status ? 'Active' : 'Inactive' }}</p>
    <p><strong>Image:</strong> <img src="{{ asset('storage/' . $menu->image) }}" alt="Menu Image" width="200"></p> --}}
</div>
@endsection







{{-- @extends('layouts.app')
    @section('content')
        <div class="container mx-auto px-4 py-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800">Menus</h1>
                {{-- <a href="{{ route('admin.menus.edit') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update Menu</a> --}}
            {{-- </div>
            <div class="container">
              <div class="row pb-2 mb-2 border-bottom">
                <div class="col-12">
                  <h1 class="h2">Menu</h1>
                </div>
              </div>

              <div class="row pb-2 mb-2 border-bottom">
                <div class="col-2">
                  <span class="fw-bold">メニュー名</span>
                </div>

                <div class="col">
                    <span>{{ $menu->name }}</span>
                </div>
              </div>

              <div class="row pb-2 mb-2 border-bottom">
                <div class="col-2">
                  <span class="fw-bold">カテゴリ</span>
                </div>

                <div class="col">
                    <span>{{ $menu->category }}</span>
                </div>
              </div>

              <div class="row pb-2 mb-2 border-bottom">
                <div class="col-2">
                  <span class="fw-bold">説明</span>
                </div>

                <div class="col">
                    <span>{{ $menu->description }}</span>
                </div>
              </div>

              <div class="row pb-2 mb-2 border-bottom">
                <div class="col-2">
                  <span class="fw-bold">価格</span>
                </div>

                <div class="col">
                    <span>{{ $menu->price }}</span>
                </div>
              </div>

              <div class="row pb-2 mb-2 border-bottom">
                <div class="col-2">
                  <span class="fw-bold">在庫</span>
                </div>

                <div class="col">
                    <span>{{ $menu->stock }}</span>
                </div>
              </div>

              <div class="mb-2">
                @if ($menu->image !== '')
                    {{-- <img src="{{ Storage::disk('s3')->url($restaurant->image) }}" alt="Restaurant Image" class="w-100"> --}}
                    {{-- <img src="{{ Storage::disk('s3')->url('restaurants/' . $restaurant->image) }}" alt="Restaurant Image" class="w-100"> --}}
                    {{-- <img src="{{ Storage::disk('s3')->temporaryUrl('/' . $restaurant->image,now()->addDay()) }}" alt="Restaurant Image" class="w-100"> --}}
                    {{-- <img src="{{ asset('storage/restaurants/' . $restaurant->image) }}" class="w-100"> --}}
                {{-- @else
                    <img src="{{ asset('/images/no_image.jpg') }}" class="w-100">
                @endif
            </div> --}}


              
            {{-- </div> --}}
            {{-- <div class="mt-4">
                <table class="w-full border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-200 px-4 py-2">id</th>
                            <th class="border border-gray-200 px-4 py-2">Name</th>
                            <th class="border border-gray-200 px-4 py-2">Category</th>
                            <th class="border border-gray-200 px-4 py-2">Price</th>
                            <th class="border border-gray-200 px-4 py-2">Stock</th>
                            <th class="border border-gray-200 px-4 py-2">???</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if($menus->isEmpty())
                        <p>No menus found.</p>
                      @else
                        @foreach ($menus as $menu)
                            <tr>
                                <td class="border border-gray-200 px-4 py-2">{{ $menu->id }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $menu->name }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $menu->category }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $menu->price }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $menu->stock }}</td>
                                <td class="border border-gray-200 px-4 py-2"></td>
                                <td class="border border-gray-200 px-4 py-2">
                                    <a href="{{ route('admin.menus.edit', $menu) }}" class="text-blue-500 hover:text-blue-600">Edit</a>
                                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                      @endif
                    </tbody>
                </table>
            </div> --}}
        {{-- </div>
    @endsection --}}