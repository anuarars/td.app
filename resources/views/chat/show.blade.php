@extends('layouts.app')

@section('content')
    <div id="chat">
        <div class="container">
            <chat-component
                :order = "{{$order->id}}"
                :user = "{{Auth::user()}}"
            ></chat-component>
        </div>
    </div>

    @if (Auth::user()->hasRole('client'))
        <div class="col-md-12 text-center mt-2 mb-2">
            <a class="btn btn-warning" href="{{route('protocol.index', $order->id)}}">Посмотреть Протокол</a>
        </div>
    @endif
    
    <div class="container">
        @if (Auth::user()->hasRole('worker'))
            <div class="text-center">
                <h1>Свои Предложения</h1>
            </div>
            <div class="owl-carousel owl-theme mt-5">
                @foreach ($order->products as $product)
                    <div class="item" style="padding: 0px;">
                        <table class="table" id="table" order_id="{{$order->id}}" user_id="{{Auth::id()}}">
                            <thead>
                                <tr>
                                    <th>Наименование</th>
                                    <th>Описание</th>
                                    <th>Единица Измерения</th>
                                    <th>Кол-во</th>
                                    <th style="width: 200px;">Цена</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$product->name}}
                                        <input type="hidden" class="product_id" value="{{$product->id}}">
                                    </td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->measure}}</td>
                                    <td>{{$product->count}}</td>
                                <td><input type="number"  class="form-control product_price" value="{{$product->user->where('id', Auth::id())->first()->pivot->price}}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
            <script>
                jQuery(document).ready(function($){
                    $('.owl-carousel').owlCarousel({
                        nav:true,
                        dots: false,
                        items: 1,
                        navText : ['<button class="btn btn-warning">Вернуться</button>','<button class="btn btn-primary" id="sendProtocol">Следующая Единица</button>']
                    });
                    $('.product_price').keyup(function(){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        var product_id = $('.product_id').map(function(){
                            return $(this).val();
                        }).get().join(",");
                        var product_price = $('.product_price').map(function(){
                            return $(this).val();
                        }).get().join(",");
                        var order_id = $('#table').attr('order_id');
                        var worker_id = $('#table').attr('user_id');

                        $.ajax({
                            url: "{{route('protocol.store')}}",
                            method:"POST",
                            data: {product_id: product_id, product_price: product_price, order_id: order_id, worker_id: worker_id},
                            success: function(data){
                                console.log(data);
                            }
                        });
                    });
                    $('#finaloffer').click(function(){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        var product_id = $('.product_id').map(function(){
                            return $(this).val();
                        }).get().join(",");
                        var product_price = $('.product_price').map(function(){
                            return $(this).val();
                        }).get().join(",");
                        var order_id = $('.table').attr('order_id');
                        var worker_id = $('.table').attr('user_id');

                        $.ajax({
                            url: "{{route('protocol.store')}}",
                            method:"POST",
                            data: {product_id: product_id, product_price: product_price, order_id: order_id, worker_id: worker_id},
                            success: function(data){
                                console.log(data);
                            }
                        });
                    });
                });
            </script>
            <div class="col-md-12 text-center mt-2 mb-2">
                <a class="btn btn-dark" href="{{route('worker.protocol.index', [$order->id, Auth::id()])}}" id="finaloffer">Протокол</a>
            </div>
            <div class="col-md-12 text-center mt-2 mb-2">
                <a class="btn btn-danger" href="{{route('home')}}" id="finaloffer">Завершить предложения и выйти</a>
            </div>
        @endif
    </div>
@endsection