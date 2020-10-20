@extends('layouts.app')

@section('content')
<h1>Информация о заявке</h1>

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            @if ($order->workers->contains(Auth::id()))
                <div class="alert alert-success mt-2 mb-2 text-center">
                    Заявка на данный заказ вами подана
                </div>
            @endif
            <div class="alert alert-success mt-2 mb-2 text-center" id="alert-send" style="display: none;">
                Заявка на данный заказ вами подана
            </div>
            <div class="alert alert-danger mt-2 mb-2 text-center" id="alert-sub" style="display: none;">
                У вас нет подписки
            </div>
            <div class="alert alert-danger mt-2 mb-2 text-center" id="alert-balance" style="display: none;">
                У вас недостаточно баланса
            </div>
        </div>
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <span class="font-weight-bold">{{$order->name}}</span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Заявка</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Наименование</label>
                        <h5>{{$order->name}}</h5>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Заявки принимаются до:</label>
                        <h5>{{\Carbon\Carbon::parse($order->review_end)->format('d.m.Y')}}</h5>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Зазказщик</label>
                        <h5>{{$order->user->name}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @if (!$order->workers->contains(Auth::id()))
                <div class="p-3 py-5" id="blockRequest">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Единицы</h4>
                    </div>
                    {{-- <form action="{{route('order.request', $order)}}" method="post">
                        @csrf --}}
                        @foreach ($order->products as $product)
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">{{$product->name}}</label>
                                    <h5>{{$product->description}}</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12"><label class="labels">Кол-во Единиц</label>
                                        <h5>{{$product->count}}</h5>
                                    </div>
                                    <label class="labels">Сумма за Единицу</label>
                                <input type="text" class="form-control price" count="{{$product->count}}">
                                    <input type="hidden" class="ids" value="{{$product->id}}">
                                    <small>Цена с НДС</small>
                                </div>
                            </div>
                        @endforeach
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Общая сумма</label>
                                <h5 id="sum">0 тг.</h5>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-success" id="sendRequest">Подать заявку</button>
                        </div>
                    {{-- </form> --}}
                </div>
                <script>
                    $('#sendRequest').click(function(){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var price = $('.price').map(function(){
                            return $(this).val();
                        }).get();
                        var ids = $('.ids').map(function(){
                            return $(this).val();
                        }).get();
                        

                        $.ajax({
                            url: "{{route('order.request', $order)}}",
                            method:"POST",
                            data: {price: price, ids: ids},
                            success: function(data){
                                if(data == 'nosub'){
                                    $("#alert-sub").css('display', 'block');
                                }else if(data == 'succesfull'){
                                    $("#blockRequest").css('display', 'none');
                                    $("#alert-send").css('display', 'block');
                                }else if(data == 'nobalance'){
                                    $("#alert-balance").css('display', 'block');
                                }
                            }
                        });
                    });

                    function add() {
                        var sum = 0;
                        $(".price").each(function() {   
                            var count = $(this).attr("count");
                            sum += +(this.value * count);
                        });
                        $('#sum').text(sum + " тг.");
                    }
                    $('.price').keyup(function(){
                        add();
                    })
                </script>
            @endif
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Файлы</h4>
                </div>
                @for ($i = 0; $i < $order->catalogs->count(); $i++)
                    <h5><a href="{{asset($order->catalogs[$i]->file)}}">Скачать файл {{$order->catalogs[$i]->id}}</a></h5>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection