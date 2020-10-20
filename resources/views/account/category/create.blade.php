@extends('layouts.account')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @include('includes.alerts')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="font-weight-bold mb-0">Подписки</h4>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach (Auth::user()->categories as $category)
                            <div class="col-md-3 mb-3">
                                <form action="{{route('worker.category.destroy', $category->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">{{$category->name}} <i class="ti-close menu-icon btn-icon-append"></i></button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="row mt-5">
                        <div class="col-md-12 grid-margin">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="font-weight-bold mb-0">Подписаться на категорию</h4>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <form action="{{route('worker.category.store')}}" method="post" class="multiple-select">
                                    @csrf
                                    <select name="category_id[]" class="form-control" multiple="multiple">
                                        <option value="0">Без родительской категории</option>
                                        @include('includes.categories', $categories)
                                    </select>
                                    <div class="col-md-12 mt-4 text-center">
                                        <button class="btn btn-success">Подписаться</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .width {
	width: 1024px;
	margin-left: auto;
	margin-right: auto;
}

h1 {
	color: #0277BD;
	font-size: 2em;
}

h1 a {
	text-decoration: underline;
}

/* Formulaire multiselect*/

.ms-choice {
	border: 1px solid #CCC;
	box-shadow: none;
}

.ms-drop input[type="checkbox"] {
	margin-right: 10px;
}

.form-control.ms-parent {
	padding: 0;
	width: 100% !important;
}

.form-control.ms-parent button {
	border: none;

}

.multiple-select select {
	border: none;
}

.multiple-select .btn-container {
	margin-top: 1.6em;
	text-align: right;
}
    </style>
@endsection