@extends('layouts.account')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="font-weight-bold mb-0">Список Предложений</h4>
        </div>
    </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover" id="table" data-mobile-responsive="true" data-check-on-init="true">
                <thead>
                    <tr>
                        <th scope="col">ID заказа</th>
                        <th scope="col">Исполнитель</th>
                        <th scope="col">Телефон</th>
                        <th scope="col">Заказ</th>
                        <th scope="col">Действия</th>
                        <th scope="col">Статус</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @foreach ($order->workers as $worker)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$worker->name}}</td>
                                <td>{{$worker->phone}}</td>
                                <td>{{$order->name}}</td>
                                <td class="d-flex justify-content-center">
                                    @if ($worker->pivot->accepted == '0')
                                        <form action="{{route('client.order.request.accept', [$worker->id, $order->id])}}" method="POST">
                                            @csrf
                                            <button type="submit" style="border: none; background: none;color:#00f; padding: 0;">
                                                Одобрить
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{route('client.order.request.destroy', [$worker->id, $order->id])}}" method="POST" class="mr-2">
                                            @csrf
                                            <button type="submit" style="border: none; background: none;color:#f00; padding: 0;">
                                                Отказать
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    @if ($worker->pivot->accepted == '0')
                                        Отклонен
                                    @else
                                        Одобрен
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            @include('includes.alerts')
        </div>
    </div>
@endsection