@extends('layouts.account')

@section('content')
    <div class="row">
        @include('includes.alerts')
        @if ($user->hasSubscribe())
            <div class="col-md-12">
                <div class="text-center">
                    <h1>Тип вашей подписки: {{$user->subscribe()->name}}</h1>
                    <br>
                    @if ($user->PaySubscribe())
                        За каждую заявку взымается 50 тенге 
                    @else
                        <h3>Срок вашей подписки до {{\Carbon\Carbon::parse($user->subscribe()->pivot->expire_at)->isoformat("D MMMM Y")}}</h3>
                        <br>
                        <h4>Подписка истекает: {{\Carbon\Carbon::parse($user->subscribe()->pivot->expire_at)->diffForHumans()}}</h4>
                    @endif
                </div>
            </div>
        @else
            <div class="text-center">
                <h1>У вас пока нет подписок</h1>
            </div>
        @endif
    </div>
    <div class="row">
        @foreach ($subscribes as $subscribe)
            <div class="col-md-3">
                <form action="{{route('subscribe.store', $subscribe->id)}}" method="post">
                    @csrf
                    <div class="card mt-4 p-0 shadow-sm">
                        <div class="card-body text-center">
                            <h4 class="my-0 font-weight-normal text-success">{{$subscribe->name}}</h4>
                            <h4 class="card-title pricing-card-title mt-2">{{$subscribe->price}} тенге</h4>
                            <p class="pb-4">{{$subscribe->description}}</p>
                            <button type="submit" class="btn btn-sm btn-outline-success">Подписаться</button>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
@endsection