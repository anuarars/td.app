@extends('layouts.app')

@section('content')
    <div class="body" style="height: 90vh;">
        <div class="veen" style="background-color: transparent;box-shadow:none;">
            <div class="wrapper" style="left:0;right:0;margin-left:auto;margin-right:auto;">
                <form method="POST" action="{{ route('password.update') }}" id="login" tabindex="500">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <h3>Изменить пароль</h3>
                    <div class="mail">
                        <input 
                            id="email" 
                            type="email" 
                            class="@error('email') is-invalid @enderror" 
                            name="email"
                            value="{{ $email ?? old('email') }}" 
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

                    <div class="mail">
                        <input 
                            id="password" 
                            type="password" 
                            class="@error('password') is-invalid @enderror" 
                            name="password" 
                            required 
                            autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label>Пароль</label>
                    </div>

                    <div class="mail">
                        <input 
                            id="password-confirm" 
                            type="password" 
                            name="password_confirmation" 
                            required autocomplete="new-password">
                        <label>Подтвердите Пароль</label>
                    </div>

                    <div class="submit">
                        <button type="submit" class="dark">Восстановить пароль</button>
                    </div>
                </form>
            </div>
        </div>	
    </div>
@endsection
