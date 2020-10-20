@extends('layouts.app')

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    @include('includes.alerts')
    <form action="{{route('admin.user.update', $user)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="mt-5 w-100" src="{{asset($user->logo)}}">
                    <span class="font-weight-bold">{{$user->name}}</span>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Баланс</label><input type="number" name="balance" class="form-control" placeholder="Название Организации" value="{{$user->balance}}"></div>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Профиль</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Название Организации</label><input type="text" name="name" class="form-control" placeholder="Название Организации" value="{{$user->name}}"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Телефон</label><input type="text" name="phone" class="form-control" placeholder="Телефон" value="{{$user->phone}}"></div>
                        <div class="col-md-12"><label class="labels">Email</label><input type="text" name="email" class="form-control" placeholder="Email" value="{{$user->email}}"></div>
                        <div class="col-md-12"><label class="labels">БИН</label><input type="text" name="bin" class="form-control" placeholder="БИН" value="{{$user->bin}}"></div>
                        <div class="col-md-12">
                            <label class="labels">О Компании</label>
                            <textarea type="text" class="form-control" name="description" placeholder="О Компании" value="">{{$user->description}}</textarea>
                        </div>
                    </div>
                    <div class="mt-5 text-center"><button type="submit" class="btn btn-primary profile-button" type="button">Изменить Профиль</button></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Адресс</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Область</label>
                            <select name="region_id" class="form-control">
                                <option value="{{$user->address->region_id}}" selected>
                                    @foreach($regions->where('id', $user->address->region_id) as $region)
                                        {{$region->name}}
                                    @endforeach
                                </option>
                                @foreach ($regions as $region)
                                    <option value="{{$region->id}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12"><label class="labels">Район</label><input type="text" class="form-control" name="district" placeholder="Район" value="{{$user->address->district}}"></div>
                        <div class="col-md-12"><label class="labels">Город/Село</label><input type="text" class="form-control" name="town" placeholder="Город/Село" value="{{$user->address->town}}"></div>
                        <div class="col-md-3"><label class="labels">Дом</label><input type="text" class="form-control" name="home" placeholder="Дом" value="{{$user->address->home}}"></div>
                        <div class="col-md-6"><label class="labels">Улица</label><input type="text" class="form-control" name="street" placeholder="Улица" value="{{$user->address->street}}"></div>
                        <div class="col-md-3"><label class="labels">Офис</label><input type="text" class="form-control" name="unit" placeholder="Офис" value="{{$user->address->unit}}"></div>
                        <div class="col-md-12"><label class="labels">Индекс</label><input type="text" class="form-control" name="postcode" placeholder="Индекс" value="{{$user->address->postcode}}"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection