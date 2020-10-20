@extends('layouts.admin')

@section('pagetitle')
    Компания|{{$order->name}}
@endsection

@section('pagename')
    <h2>Компания|{{$order->name}}</h2>
@endsection

@section('content')
    <div class="container__admin">
        <div class="card shadow rounded">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.order.update', $order) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Наименование</label>
                
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$order->name}}" required autocomplete="name" autofocus>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Категория</label>
                
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$order->category->name}}" required autocomplete="email">
                        </div>
                    </div>
                
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Редактировать
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection