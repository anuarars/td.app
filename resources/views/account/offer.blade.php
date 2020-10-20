@extends('layouts.account')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="font-weight-bold mb-0">Поданные Заявки</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-striped" id="table" data-mobile-responsive="true" data-check-on-init="true">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Название</th>
                        <th scope="col">Категория</th>
                        <th scope="col">Дата Публикации</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->orders as $order)
                    <tr>
                        <th scope="row">{{$order->id}}</th>
                        <td><a href="{{route('order.show', $order->id)}}">{{$order->name}}</a></td>
                        <td>{{$order->category->name}}</td>
                        <td>{{$order->review_start}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12 mt-2 d-flex justify-content-center">
            {{-- {{$orders->links()}} --}}
        </div>
    </div>
@endsection