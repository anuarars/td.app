@extends('layouts.admin')

@section('pagetitle')
    Все компании
@endsection

@section('pagename')
    <h2>Компании</h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('includes.alerts')
            <table class="table table-hover table-striped" id="table" data-mobile-responsive="true" data-check-on-init="true">
                <thead>
                    <tr>
                        <th >ID</th>
                        <th>Наименование</th>
                        <th>Email</th>
                        <th>БИН</th>
                        <th>Телефон</th>
                        <th>Роль</th>
                        <th>Баланс</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                        <td>{{$user->id}}</td>
                        <td><a class="text-dark" href="{{route('admin.user.show', $user)}}">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->bin}}</td>
                        <td>{{$user->phone}}</td>
                        <td>
                            @if ($user->hasRole('client'))
                                Поставщик
                            @endif
                            @if ($user->hasRole('worker'))
                                Исполнитель
                            @endif
                            {{-- {{implode(', ', $user->roles()->get()->pluck('name')->toArray())}} --}}
                        </td>
                        <td>{{$user->balance}} тг.</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{route('admin.user.edit', $user->id)}}" class="mr-2 text-warning">
                                <i class="fa fa-pencil fa-lg"></i>
                            </a>

                            <form method="post" action="{{route('admin.user.destroy', $user->id)}}">
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
                <div class="mt-2 d-flex justify-content-center">
                    {{$users->links()}}
                </div>
        </div>
    </div>
@endsection
