@extends('layouts.admin')

@section('content')
    @include('includes.alerts')
    <div class="d-flex justify-content-center mt-2 mb-2">
        <a href="{{route('admin.page.create')}}" class="btn btn-dark">Создать страницу</a>
    </div>
    <table class="table table-hover table-bordered" id="table" data-mobile-responsive="true" data-check-on-init="true">
        <thead>
            <tr>
                <th class="text-center">Название</th>
                <th class="text-center">Публикация</th>
                <th class="text-center">Позиция</th>
                <th class="text-center">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
                <tr>
                    <td class="text-center">{{$page->name}}</td>
                    <td class="text-center">
                        @if ($page->active == "0")
                            Неопубликован
                        @else
                            Опубликован
                        @endif
                    </td>
                    <td class="text-center">{{$page->position}}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{route('admin.page.edit', $page->id)}}" class="text-warning mr-2">
                            <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                        </a>

                        <form method="post" action="{{route('admin.page.destroy', $page->id)}}">
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