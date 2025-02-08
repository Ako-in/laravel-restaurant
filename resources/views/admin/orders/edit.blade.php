@extends('layouts.admin')
@section('content')

<h1>注文ステータス変更</h1>
form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group
        <label for="status">ステータス</label>
        <select name="status" id="status" class="form-control">
            <option value="2" {{ old('status', $order->status) == 2 ? 'selected' : '' }}>確定 confirmed</option>
            <option value="1" {{ old('status', $order->status) == 1 ? 'selected' : '' }}>保留 pending</option>
            <option value="0" {{ old('status', $order->status) == 0 ? 'selected' : '' }}>キャンセル cancel</option>
        </select>
        @error('status')
            <p class="text-danger">{{ $message }}</p>
        @enderror

