@extends('layouts.app')

@section('content')
    <div class="body">
        <div class="veen" style="background-color: transparent;box-shadow:none;">
            <div class="wrapper" style="left:0;right:0;margin-left:auto;margin-right:auto;width:100%;">
                <form method="POST" action="{{ route('verification.resend') }}" id="login" tabindex="500">
                    @csrf
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Новое письмо с подтверждением почтового ящика отправлено на почту') }}
                        </div>
                    @endif
                    <h4>
                        {{ __('Прежде чем продолжить пожалуйста подтвердите почту.') }}
                        {{ __('Если вы не получали письмо, попробуйте отправить заново') }}
                    </h4>
                    <div class="submit">
                        <button type="submit" class="dark">Отправить заново</button>
                    </div>
                </form>
            </div>
        </div>	
    </div>
@endsection