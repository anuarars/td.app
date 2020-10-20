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
                            @foreach ($users as $user)
                                <th>{{$user}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($names as $name)
                            <tr>
                                @foreach ($name as $price)     
                                    <td>{{$price}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center mt-2 mb-2">
                    <a href="{{route('protocol.download', $order->id)}}" class="btn btn-success">Скачать Протокол</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection