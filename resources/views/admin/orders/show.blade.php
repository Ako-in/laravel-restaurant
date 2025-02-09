@extends('layouts.app')

@section('content')
    <h1>注文詳細</h1>

    <p><strong>注文ID:</strong> {{ $order->id }}</p>
    <p><strong>ユーザー名:</strong> {{ $order->user->name }}</p>
    <p><strong>合計金額:</strong> {{ $order->total }}円</p>
    <p><strong>ステータス:</strong> {{ $order->status === 1 ? '確定' : '保留' }}</p>
    <p><strong>日時:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>

    <h2>注文内容</h2>
    <table>
        <thead>
            <tr>
                <th>メニュー</th>
                <th>数量</th>
                <th>価格</th>
                <th>合計</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->menu as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->pivot->quantity }}</td>
                    <td>{{ $item->pivot->price }}円</td>
                    <td>{{ $item->pivot->total }}円</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
