@component('mail::message')
Пришла новая заявка на ваш заказ

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
