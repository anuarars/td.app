@extends('layouts.app')

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="w-100 mt-5" src="{{asset($user->logo)}}"><span class="font-weight-bold">{{$user->name}}</span><span class="text-black-50">{{$user->email}}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Профиль Компании</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="labels">Название</label>
                        <h5>{{$user->name}}</h5>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">О Компании</label>
                        <h5>{{$user->description}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Контактные Данные</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="labels">Email</label>
                        <h5>{{$user->email}}</h5>
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Телефон</label>
                        <h5>{{$user->phone}}</h5>
                    </div>
                </div>
            </div>
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Адресс</h4>
                </div>
               <div class="row">
                <div class="col-md-6">
                    <label class="labels">Район</label>
                    <h5>{{$user->address->district}}</h5>
                </div>
                <div class="col-md-6">
                    <label class="labels">Город/Село</label>
                    <h5>{{$user->address->town}}</h5>
                </div>
               </div>
               <div class="row">
                    <div class="col-md-3">
                        <label class="labels">№</label>
                        <h5>{{$user->address->home}}</h5>
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Улица</label>
                        <h5>{{$user->address->street}}</h5>
                    </div>
                    <div class="col-md-3">
                        <label class="labels">Офис</label>
                        <h5>{{$user->address->unit}}</h5>
                    </div>
               </div>
               <div class="row">
                    <div class="col-md-12">
                        <label class="labels">Индекс</label>
                        <h5>{{$user->address->postcode}}</h5>
                    </div>
               </div>
            </div>
        </div>
    </div>
@endsection