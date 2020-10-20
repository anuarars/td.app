@extends('layouts.account')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Заказ {{$order->name}}</h4>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-striped" id="table" data-mobile-responsive="true" data-check-on-init="true">
                <thead>
                    <tr>
                        <th scope="col">Поставщик</th>
                        <th scope="col">Коммерческое Предложение</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $offer)
                        <tr>
                            <td>{{$offer->user->name}}</td>
                            <td><a href="{{asset($offer->file)}}">Коммерческое Предложение</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection