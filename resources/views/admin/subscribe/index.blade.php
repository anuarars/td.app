@extends('layouts.admin')

@section('content')
@include('includes.alerts')
    <div class="d-flex justify-content-center mt-2 mb-2">
        <a href="{{route('admin.subscribe.create')}}" class="btn btn-dark">Создать подписку</a>
    </div>
    <table class="table table-hover table-bordered" id="table" data-mobile-responsive="true" data-check-on-init="true">
        <thead>
            <tr>
                <th class="text-center">Название</th>
                <th class="text-center">Описание</th>
                <th class="text-center">Длительность</th>
                <th class="text-center">Цена</th>
                <th class="text-center">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subscribes as $subscribe)
                <tr>
                    <td class="text-center">
                        <a href="{{route('admin.subscribe.edit', $subscribe)}}" class="text-dark">{{$subscribe->name}}</a>
                    </td>
                    <td class="text-center">{{$subscribe->description}}</td>
                    <td class="text-center">{{$subscribe->integer}} {{$subscribe->measure}}</td>
                    <td class="text-center">{{$subscribe->price}} тг.</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{route('admin.subscribe.edit', $subscribe->id)}}" class="text-warning mr-2">
                            <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                        </a>

                        <form method="post" action="{{route('admin.subscribe.destroy', $subscribe->id)}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" style="border: none; background: none;color:#f00; padding: 0;">
                                <i class="fa fa-trash fa-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection