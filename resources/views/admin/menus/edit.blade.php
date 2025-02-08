@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <h1 class="">Update menus</h1>
    <form action="{{ route('admin.menus.update',$menu->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="flex flex-col mt-4">
          <label for="category_id" class="text-gray-800">Category</label>
          <select name="category_id" id="category_id" class="border border-gray-200 px-4 py-2 mt-2">
              <option value="">Select a category</option>
              @foreach ($categories as $category)
                  {{-- <option value="{{ $category->id }}">{{ $category->name }}</option> --}}
                  <option value="{{ $category->id }}" {{ old('category_id',$menu->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
              @endforeach
          </select>
          @error('category_id')
              <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
          @enderror
      </div>
      
      <div class="flex flex-col mt-4">
          <label for="category" class="text-gray-800">Name</label>
          <input type="text" name="name" id="name" class="border border-gray-200 px-4 py-2 mt-2"value="{{ $menu->name}}">
          @error('name')
              <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
          @enderror
      </div>

      <div class="flex flex-col mt-4">
          <label for="price" class="text-gray-800">Price</label>
          <input type="number" name="price" id="price" class="border border-gray-200 px-4 py-2 mt-2" value="{{$menu->price}}">
          @error('price')
              <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
          @enderror
      </div>

      <div class="flex flex-col mt-4">
          <label for="description" class="text-gray-800">Description</label>
          <description name="description" id="description" rows="4" class="border border-gray-200 px-4 py-2 mt-2">{{ old('description') }}</textarea>
          @error('description')
              <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
          @enderror
      </div>

      <div class="flex flex-col mt-4">
          <label for="image" class="text-gray-800">Image</label>
          {{-- <input type="file" name="image" id="image" class="border border-gray-200 px-4 py-2 mt-2"> --}}
          @error('image')
              <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
          @enderror

          @if ($menu->image)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $menu->image) }}" alt="Current Image" class="w-32 h-32 object-cover">
            </div>
          @endif
          {{-- 新しい画像のアップロード --}}
          <input type="file" name="image" id="image" class="border border-gray-200 px-4 py-2 mt-2">
      </div>

      <div class="flex flex-col mt-4">
          <label for="status" class="text-gray-800">Status</label>
          <select name="status" id="status" class="border border-gray-200 px-4 py-2 mt-2"value="{{old('status')}}">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
              <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
          @enderror
      </div>

      <div class="flex flex-col mt-4">
          <label for="stock" class="text-gray-800">Stock</label>
          <input type="number" name="stock" id="stock" class="border border-gray-200 px-4 py-2 mt-2" min="0" value="{{$menu->stock}}">
          @error('stock')
              <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
          @enderror
      </div>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4">Update Menu</button>
    </form>
</div>


@endsection