@extends('layouts.app')

@section('content')
    <div class="body">
        <div class="veen">
            <div class="login-btn splits">
                <p>Уже зарегистрированы?</p>
                <button class="active">Войти</button>
            </div>
            <div class="rgstr-btn splits">
                <p>Не зарегистрированы?</p>
                <button>Регистрация</button>
            </div>
            <div class="wrapper">
                <form method="POST" action="{{ route('login') }}" id="login" tabindex="500">
                    @csrf
                    <h3>Войти</h3>
                    <div class="mail">
                        <input 
                            type="email" 
                            name="email"
                            id="email" 
                            class="@error('email') is-invalid @enderror" 
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="email" 
                            autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        <label>Email</label>
                    </div>
                    <div class="passwd">
                        <input 
                            type="password" 
                            id="password" 
                            class="@error('password') is-invalid @enderror" 
                            name="password" 
                            required 
                            autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label>Пароль</label>
                    </div>
                    <div class="submit">
                        <button type="submit" class="dark">Войти</button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link text-danger" href="{{ route('password.request') }}">
                                Забыли пароль?
                            </a>
                        @endif
                    </div>
                </form>
                <form id="register" tabindex="502" method="POST" action="{{ route('register') }}">
                    @csrf
                    <h3>Регистрация</h3>
                    <div class="name">
                        <input 
                            type="text" 
                            name="name"
                            class="@error('name') is-invalid @enderror" 
                            value="{{ old('name') }}" 
                            required 
                            autocomplete="name"
                            autofocus
                            id="name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label>Название организации</label>
                    </div>
                    <div class="mail">
                        <input 
                            type="mail" 
                            name="email"
                            class="@error('email') is-invalid @enderror" 
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="email"
                            id="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="email">Email</label>
                    </div>
                    <div class="uid">
                        <input 
                            type="text" 
                            name="bin"
                            id="bin" 
                            class="@error('bin') is-invalid @enderror"
                            value="{{ old('bin') }}"
                            required>
                        @error('bin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="bin">БИН</label>
                    </div>
                    <div class="passwd">
                        <input 
                            type="phone" 
                            name="phone"
                            class="@error('phone') is-invalid @enderror"
                            value="{{ old('phone') }}" 
                            required
                            id="phone"
                            >
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="phone">Телефон</label>
                    </div>
                    <div class="passwd">
                        <input 
                            type="password" 
                            name="password"
                            id="password" 
                            type="password"
                            required 
                            autocomplete="new-password"
                            class=" @error('password') is-invalid @enderror">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="password">Пароль</label>
                    </div>
                    <div class="passwd">
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            id="password-confirm">
                        <label>Подтвердить пароль</label>
                    </div>
                    <style>
                        
                    </style>
                    <div class="veen-radio" style="height: 60px;">
                        <div class="d-flex justify-content-start align-items-center mb-2">
                            <input type="radio" name="role" id="1" value="client"  style="height: 20px;width:20px;">
                            <span class="ml-2">Заказщик</span>
                        </div>
                        <div class="d-flex justify-content-start align-items-center">
                            <input type="radio" name="role" id="1" value="worker"  style="height: 20px;width:20px;">
                            <span class="ml-2">Поставщик</span>
                        </div>
                    </div>
                    <div class="submit">
                        <button type="submit" class="dark">Регистрация</button>
                    </div>
                </form>
            </div>
        </div>	
    </div>
@endsection