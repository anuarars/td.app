@extends('layouts.admin')

@section('pagetitle')
    Все заказы
@endsection

@section('pagename')
    <h2>Заказы</h2>
@endsection

@section('content')
    @include('includes.alerts')
    <table class="table table-hover table-striped" id="table" data-mobile-responsive="true" data-check-on-init="true">
        <thead>
            <tr>
                <th>ID</th>
                <th>Заказчик</th>
                <th>Категория</th>
                <th>Наименование</th>
                <th>Рассмотрение заявок</th>
                <th>Чат</th>
                <th>Протокол</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                <td>{{$order->id}}</td>
                <td><a href="{{route('admin.user.show', $order->user)}}" class="text-dark">{{$order->user->name}}</a></td>
                <td>{{$order->category->name}}</td>
                <td>{{$order->name}}</td>
                <td>{{\Carbon\Carbon::parse($order->review_start)->format('d.m.Y')}} - 
                    {{\Carbon\Carbon::parse($order->review_end)->format('d.m.Y')}}
                </td>
                <td>{{\Carbon\Carbon::parse($order->order_discuss)->format('d.m.Y')}}</td>
                <td><a href="{{route('protocol.index', $order->id)}}">Посмотреть Протокол</a></td>
                <td class="d-flex justify-content-center">
                    <a href="{{route('admin.order.edit', $order)}}" class="mr-2">
                        <i class="fa fa-pencil"></i>
                    </a>

                    <form method="post" action="{{route('admin.order.destroy', $order->id)}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" style="border: none; background: none;color:#f00; padding: 0;">
                            <i class="fa fa-trash fa-lg"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-2">
        {{$orders->links()}}
    </div>
@endsection