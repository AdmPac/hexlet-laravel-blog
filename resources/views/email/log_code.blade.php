@component('mail::message')
# Закончите регистрацию,

Нажмите кнопку для завершения верификации

@component('mail::button', ['url' => route('login.verify.сode', ['code' => $code])])
Подтвердить регистрацию
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
