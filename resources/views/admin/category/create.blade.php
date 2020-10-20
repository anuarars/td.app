@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    <form action="{{route('admin.category.store')}}" method="post">
        @csrf
        <div class="form-group row mt-2 mb-2">
            <label class="col-md-3" for="category_name">Название категории</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="name" placeholder="Название категории" id="category_name">
            </div>
        </div>
        <div class="form-group row mb-2 mt-2">
            <label class="col-md-3" for="category_desc">Описание категории</label>
            <div class="col-md-9">
                <textarea name="description" class="form-control" placeholder="Описание" id="category_desc"></textarea>
            </div>
        </div>
        <div class="form-group row mb-2 mt-2">
            <label class="col-md-3" for="">Родительская категория</label>
            <div class="col-md-9">
                <select name="parent_id" class="form-control">
                    <option value="0">Без родительской категории</option>
                    @include('includes.categories', $categories)
                </select>
            </div>
        </div>
        <div class="text-center mt-2 mb-2">
            <button type="submit" class="btn btn-dark">Добавить категорию</button>
        </div>
    </form>
</div>
@endsection