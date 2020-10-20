@extends('layouts.app')

@section('content')
<div class="row">
    <div class="container">
        <div class="row">
            <h1 class="text-center">Протокол | {{$order->name}}</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Товар</th>
                            <th>Цена</th>
                            <th>Исполнитель</th>
                            <th>Срок</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($protocols as $protocol)
                            <tr>
                                <td>{{$protocol->product->name}}</td>
                                <td>{{$protocol->price}} тг.</td>
                                <td>{{$protocol->worker->name}}</td>
                                <td>{{$protocol->execution_date}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-md-12 text-center text-white">
                    <a href="{{route('protocol.download', $order->id)}}" class="btn btn-danger mb-4 mt-4">Скачать Протокол</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection