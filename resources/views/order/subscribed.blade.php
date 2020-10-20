@extends('layouts.account')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Заявки из подписок</h4>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        @foreach ($orders as $order)
            <div class="col-md-4 mb-4">
                <div class="card p-2">
                    <h4 class="card-title font-weight-bold text-center">{{$order->name}}</h4>
                    <small class="card-text">Категория: {{$order->category->name}}</small>
                    <p>Заявки принимаются до: {{\Carbon\Carbon::parse($order->review_end)->format('d.m.Y')}}</p>
                    <div class="m-2 text-center">
                        <a href="{{route('order.show', $order)}}" class="btn btn-outline-warning btn-sm">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-md-12 mt-4">
            <div class="d-flex justify-content-center">
                {{$orders->links()}}
            </div>
        </div>
    </div>
@endsection