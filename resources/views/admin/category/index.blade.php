@extends('layouts.admin')

@section('pagetitle')
    Все Категории
@endsection

@section('pagename')
    <h2>Категории</h2>
@endsection

@section('content')
        @include('includes.alerts')
        <div class="text-center mt-2 mb-2">
            <a href="{{route('admin.category.create')}}" class="btn btn-success">Создать категорию</a>
        </div>
        <table class="table table-hover table-striped" id="table" data-mobile-responsive="true" data-check-on-init="true">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Наименование</th>
                    <th>Родительская категория</th>
                    <th class="text-center">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                    <td>{{$category->id}}</td>
                    <td><a href="{{route('admin.category.edit', $category)}}" class="text-dark">{{$category->name}}</a></td>
                    <td >
                        @if(isset($category->parent->name))
                            {{$category->parent->name}}
                        @else
                            Нет Родительской категории
                        @endif
                    </td>
                    <td class="d-flex justify-content-center">
                        <a href="{{route('admin.category.edit', $category->id)}}" class="text-warning mr-2">
                            <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                        </a>

                        <form method="post" action="{{route('admin.category.destroy', $category->id)}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" style="border: none; background: none;color:#f00; padding: 0;">
                                <i class="fa fa-trash fa-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Категорий пока нет</td>
                    </tr>
                @endforelse
            </tbody>
            </table>
            <div class="mt-2 d-flex justify-content-center">
                <div class="text-dark">{{$categories->links()}}</div>
            </div>
@endsection