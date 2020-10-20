@extends('layouts.account')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('includes.alerts')
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="font-weight-bold mb-0">Новая Заявка</h4>
                            </div>
                        </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('client.order.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Название Заявки">
                            </div>
    
                            <div class="col-md-6">
                                <select name="category_id" class="form-control" required>
                                    <option selected="" disabled="">Выбрать категорию</option>
                                    @include('includes.categories', $categories)
                                </select>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mt-4 mb-2">
                                    <label for="password-confirm" class="col-md-5">Конец рассмотрения заявок</label>
                    
                                    <div class="col-md-7">
                                        <input type="date" name="review_end" class="form-control" value="{{ old('review_end') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row mt-4 mb-2">
                                    <label for="password-confirm" class="col-md-5">Обсуждение предложений</label>
                    
                                    <div class="col-md-7">
                                        <input type="datetime-local" name="order_discuss" class="form-control" value="{{ old('order_discuss') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="d-flex justify-content-center w-100">
                                <div class="row mt-2 mb-2 upload-logo-wrap">
                                    <span class="label">
                                        Загрузить Дополнительные Файлы
                                    </span>
                                    <input type="file" name="catalog[]" multiple="true" style="position: absolute;width:100%;height:100%;opacity:0;">
                                </div>
                            </div>
                        </div>
                        <hr>
            
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="font-weight-bold mb-0">Добавить Товары</h4>
                                </div>
                            </div>
                            </div>
                        </div>

                        <table class="table table-hover" id="table" data-mobile-responsive="true" data-check-on-init="true">
                            <thead>
                                <tr>
                                    <th data-width="50">ID</th>
                                    <th data-width="300">Название</th>
                                    <th data-width="400">Описание</th>
                                    <th data-width="100">Единица Измерения</th>
                                    <th data-width="150">Кол-во</th>
                                </tr>
                            </thead>
                            <tbody class="product-row">
                                <tr>
                                    <td>
                                        <div class="form-control text-center">1</div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Название Единицы" name="product_name[]" value="{{ old('product_name.0') }}">
                                    </td>
                                    <td>
                                        <input name="product_description[]" placeholder="Описание Единицы" class="form-control" value="{{ old('product_description.0') }}">
                                    </td>
                                    <td>
                                        <input type="text" name="product_measure[]" class="form-control" value="{{ old('product_measure.0') }}">
                                    </td>
                                    <td>
                                        <input type="number" name="product_count[]" class="form-control" value="{{ old('product_count.0') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-control text-center">2</div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Название Единицы" name="product_name[]" value="{{ old('product_name.1') }}">
                                    </td>
                                    <td>
                                        <input name="product_description[]" placeholder="Описание Единицы" class="form-control" value="{{ old('product_description.1') }}">
                                    </td>
                                    <td>
                                        <input type="text" name="product_measure[]" class="form-control" value="{{ old('product_measure.1') }}">
                                    </td>
                                    <td>
                                        <input type="number" name="product_count[]" class="form-control" value="{{ old('product_count.1') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-control text-center">3</div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Название Единицы" name="product_name[]" value="{{ old('product_name.2') }}">
                                    </td>
                                    <td>
                                        <input name="product_description[]" placeholder="Описание Единицы" class="form-control" value="{{ old('product_description.2') }}">
                                    </td>
                                    <td>
                                        <input type="text" name="product_measure[]" class="form-control" value="{{ old('product_measure.2') }}">
                                    </td>
                                    <td>
                                        <input type="number" name="product_count[]" class="form-control" value="{{ old('product_count.2') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-control text-center">4</div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Название Единицы" name="product_name[]" value="{{ old('product_name.3') }}">
                                    </td>
                                    <td>
                                        <input name="product_description[]" placeholder="Описание Единицы" class="form-control" value="{{ old('product_description.3') }}">
                                    </td>
                                    <td>
                                        <input type="text" name="product_measure[]" class="form-control" value="{{ old('product_measure.3') }}">
                                    </td>
                                    <td>
                                        <input type="number" name="product_count[]" class="form-control" value="{{ old('product_count.3') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-control text-center">5</div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Название Единицы" name="product_name[]" value="{{ old('product_name.4') }}">
                                    </td>
                                    <td>
                                        <input name="product_description[]" placeholder="Описание Единицы" class="form-control" value="{{ old('product_description.4') }}">
                                    </td>
                                    <td>
                                        <input type="text" name="product_measure[]" class="form-control" value="{{ old('product_measure.4') }}">
                                    </td>
                                    <td>
                                        <input type="number" name="product_count[]" class="form-control" value="{{ old('product_count.4') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-control text-center">6</div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Название Единицы" name="product_name[]" value="{{ old('product_name.5') }}">
                                    </td>
                                    <td>
                                        <input name="product_description[]" placeholder="Описание Единицы" class="form-control" value="{{ old('product_description.5') }}">
                                    </td>
                                    <td>
                                        <input type="text" name="product_measure[]" class="form-control" value="{{ old('product_measure.5') }}">
                                    </td>
                                    <td>
                                        <input type="number" name="product_count[]" class="form-control" value="{{ old('product_count.5') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-control text-center">7</div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Название Единицы" name="product_name[]" value="{{ old('product_name.6') }}">
                                    </td>
                                    <td>
                                        <input name="product_description[]" placeholder="Описание Единицы" class="form-control" value="{{ old('product_description.6') }}">
                                    </td>
                                    <td>
                                        <input type="text" name="product_measure[]" class="form-control" value="{{ old('product_measure.6') }}">
                                    </td>
                                    <td>
                                        <input type="number" name="product_count[]" class="form-control" value="{{ old('product_count.6') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-control text-center ids">8</div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Название Единицы" name="product_name[]" value="{{ old('product_name.7') }}">
                                    </td>
                                    <td>
                                        <input name="product_description[]" placeholder="Описание Единицы" class="form-control" value="{{ old('product_description.7') }}">
                                    </td>
                                    <td>
                                        <input type="text" name="product_measure[]" class="form-control" value="{{ old('product_measure.7') }}">
                                    </td>
                                    <td>
                                        <input type="number" name="product_count[]" class="form-control" value="{{ old('product_count.7') }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row mt-2">
                            <div class="col-md-12 text-right">
                                <a class="btn btn-sm btn-warning" id="product_more" href="#publish"><i class="ti-plus menu-icon"></i> Добавить еще товар</a>
                            </div>
                        </div>
            
            
                        <div class="text-center mt-2" id="publish">
                            <button type="submit" class="btn btn-dark">
                                Опубликовать заявку
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        td {
            padding: 0px!important;
            border: none!important;
        }
    </style>
@endsection