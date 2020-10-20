@extends('layouts.account')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="font-weight-bold mb-0">Протокол</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('includes.alerts')
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Наименование</th>
                        <th>Описание</th>
                        <th>Единица Измерения</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->measure}}</td>
                        <td>{{$product->count}}</td>
                        <td>{{$product->pivot->price}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-2 text-center">
            <a class="btn btn-success" href="{{route('worker.protocol.download', [$order_id, Auth::id()])}}">Скачать Протокол</a>
            <form action="{{route('worker.protocol.upload', $order_id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="offer">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
@endsection