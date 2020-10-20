@extends('layouts.account')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Чат Расписание</h4>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover" id="table" data-mobile-responsive="true" data-check-on-init="true">
                <thead>
                    <tr>
                        <th scope="col">Название</th>
                        <th scope="col">Дата переговоров</th>
                        <th scope="col">Ссылка</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @if (Auth::user()->hasRole('worker'))
                            @if ($order->workers()->where('user_id', Auth::id())->first()->pivot->accepted == '1')
                                <tr>
                                    <td>{{$order->name}}</td>
                                    <td>{{\Carbon\Carbon::parse($order->order_discuss)->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{route('chat.show', $order)}}">Ссылка на чат</a>
                                    </td>
                                </tr>
                            @endif
                        @endif
                        @if (Auth::user()->hasRole('client'))
                            <tr>
                                <td>{{$order->name}}</td>
                                <td>{{\Carbon\Carbon::parse($order->order_discuss)->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('chat.show', $order)}}">Ссылка на чат</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection