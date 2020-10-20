@extends('layouts.account')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Заявка</th>
                        <th>Протокол</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($protocols as $protocol)
                        <tr>
                            <td>{{$protocol->order->name}}</td>
                            <td><a href="{{asset($protocol->file)}}">Скачать</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection