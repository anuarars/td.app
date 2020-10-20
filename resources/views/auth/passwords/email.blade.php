@extends('layouts.app')

@section('content')
    <div class="body" style="height: 90vh;">
        <div class="veen" style="background-color: transparent;box-shadow:none;">
            <div class="wrapper" style="left:0;right:0;margin-left:auto;margin-right:auto;">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}" id="login" tabindex="500">
                    @csrf
                    <h3>Восстановить пароль</h3>
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
                    <div class="submit">
                        <button type="submit" class="dark">Восстановить пароль</button>
                    </div>
                </form>
            </div>
        </div>	
    </div>
@endsection
