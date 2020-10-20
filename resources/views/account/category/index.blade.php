@extends('layouts.account')

@section('content')
    <h1>Категории в подписке</h1>
    @foreach (Auth::user()->categories as $category)
        <p>{{$category->name}}</p>
    @endforeach
@endsection