@extends('layouts.app')
    @section('content')
        <div class="container mx-auto px-4 py-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800">Menus</h1>
                <a href="{{ route('admin.menus.create') }}" class="bg-blue-500 hover:bg-blue-600 text-black px-4 py-2 rounded">Add Menu</a>
            </div>
            <div class="mt-4">
                <table class="w-full border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-200 px-4 py-2">id</th>
                            <th class="border border-gray-200 px-4 py-2">Name</th>
                            <th class="border border-gray-200 px-4 py-2">Category</th>
                            <th class="border border-gray-200 px-4 py-2">Price</th>
                            <th class="border border-gray-200 px-4 py-2">Stock</th>
                            <th class="border border-gray-200 px-4 py-2">Description</th>
                            {{-- <th class="border border-gray-200 px-4 py-2">???</th> --}}
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
                                <td class="border border-gray-200 px-4 py-2">{{ $menu->category->name }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $menu->price }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $menu->stock }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $menu->description }}</td>
                                {{-- <td class="border border-gray-200 px-4 py-2"></td> --}}
                                <td class="border border-gray-200 px-4 py-2">
                                    <a href="{{ route('admin.menus.show', $menu) }}" class="text-blue-500 hover:text-blue-600">View</a>
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
            </div>
        </div>
    @endsection