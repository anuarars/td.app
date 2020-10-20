@extends('layouts.admin')

@section('content')
    <script src="https://cdn.tiny.cloud/1/vuko5n8zosfrtuvle80aeae8o7nyj7sm85hwt10pa3bie19s/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
          selector: 'textarea',
          language: 'ru',
          plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          toolbar_mode: 'floating',
        });
    </script>
    @include('includes.alerts')
    <form action="{{route('admin.page.store')}}" method="post">
        @csrf
        <div class="form-group mt-2 mb-2">
            <input type="text" name="name" class="form-control" placeholder="Название страницы">
        </div>
        <textarea class="form-control" name="body" cols="30" rows="20"></textarea>
        <div class="form-group d-flex justify-content-center alignt-items-center mt-4">
                <div class="mr-2">
                    <input type="number" name="position" class="form-control" placeholder="Позиция">
                </div>
                <div class="mr-2">
                    <select name="active" class="form-control">
                        <option value="0">Неопубликован</option>
                        <option value="1">Опубликован</option>
                    </select>
                </div>
            <button type="submit" class="btn btn-success ml-2">Создать страницу</button>
        </div>
    </form>
@endsection