@extends('layouts.app')

@section('content')
    <h1>注文一覧</h1>

    @if ($orders->isEmpty())
        <p>注文はありません。</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>注文ID</th>
                    <th>テーブル番号</th>
                    {{-- <th>ユーザー名</th> --}}
                    <th>オーダーアイテム</th>
                    <th>数量</th>
                    <th>合計金額</th>
                    <th>ステータス</th>
                    <th>日時</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{$order->table_number}}</td>
                        {{-- <td>{{ $order->user->name }}</td> --}}
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->quantity }}pcs</td>
                        <td>{{ $order->total }}円</td>
                        <td>{{ $order->status == 1 ? '保留' : ($order->status == 2 ? '確定' : 'キャンセル') }}</td>

                        {{-- <td>{{ $order->status === 1 ? '確定' : '保留' }}</td> --}}
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            {{-- <a href="{{ route('admin.orders.show', $order->id) }}"> 詳細を見る</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
