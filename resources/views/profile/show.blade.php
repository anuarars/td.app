@extends('layouts.app')

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <span class="font-weight-bold">{{$company->name}}</span><span class="text-black-50">{{$company->email}}</span><span> </span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Профиль Компании</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="labels">Название</label>
                        <h5>{{$company->name}}</h5>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">О Компании</label>
                        <h5>{{$company->description}}</h5>
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
                        <h5>{{$company->email}}</h5>
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Телефон</label>
                        <h5>{{$company->phone}}</h5>
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
                    <h5>{{$company->address->district}}</h5>
                </div>
                <div class="col-md-6">
                    <label class="labels">Город/Село</label>
                    <h5>{{$company->address->town}}</h5>
                </div>
               </div>
               <div class="row">
                    <div class="col-md-3">
                        <label class="labels">№</label>
                        <h5>{{$company->address->home}}</h5>
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Улица</label>
                        <h5>{{$company->address->street}}</h5>
                    </div>
                    <div class="col-md-3">
                        <label class="labels">Офис</label>
                        <h5>{{$company->address->unit}}</h5>
                    </div>
               </div>
               <div class="row">
                    <div class="col-md-12">
                        <label class="labels">Индекс</label>
                        <h5>{{$company->address->postcode}}</h5>
                    </div>
               </div>
            </div>
        </div>
    </div>
@endsection