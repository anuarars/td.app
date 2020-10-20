@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    <form action="{{route('admin.subscribe.store')}}" method="post">
        @csrf
        <div class="form-group row mt-2 mb-2">
            <label class="col-md-3" for="subscribe_name">Название подписки</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="name" placeholder="Название подписки" id="subscribe_name">
            </div>
        </div>
        <div class="form-group row mt-2 mb-2">
            <label class="col-md-3" for="subscribe_desc">Описание подписки</label>
            <div class="col-md-8">
                <textarea class="form-control" name="description" placeholder="Описание подписки" id="subscribe_desc" rows="6"></textarea>
            </div>
        </div>
        <div class="form-group row mt-2 mb-2">
            <label class="col-md-3">Стоимость</label>
            <div class="col-md-8">
                <input type="number" class="form-control" name="price" placeholder="Стоимость в тенге">
            </div>
        </div>
        <div class="form-group row mt-2 mb-2">
            <label class="col-md-3">Длительность</label>
            <div class="col-md-4">
                <select name="integer" class="form-control" id="integer">
                    @for ($i = 1; $i <= 31; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4">
                <select name="measure" class="form-control" id="measure">
                    <option class="measureItem" value="day">День</option>
                    <option class="measureItem" value="week">Неделя</option>
                    <option class="measureItem" value="month">Месяц</option>
                    <option class="measureItem" value="year">Год</option>
                    <option class="measureItems" style="display: none;" value="days">День</option>
                    <option class="measureItems" style="display: none;" value="weeks">Неделя</option>
                    <option class="measureItems" style="display: none;" value="months">Месяц</option>
                    <option class="measureItems" style="display: none;" value="years">Год</option>
                </select>
            </div>
        </div>
        <div class="form-group mt-2 d-flex justify-content-center">
            <button class="btn btn-success">Создать тип подписки</button>
        </div>
    </form>
</div>
@endsection