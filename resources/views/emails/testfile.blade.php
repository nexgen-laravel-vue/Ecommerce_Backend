<x-mail::message>
# Welcome to first generated mail
Dear {{$name}},
The demo  body of your message.
<x-mail::button :url={{config('APP_URL')}}.{{config('APP_RESETPASSWORDLINK')}}>
Button Text
</x-mail::button>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
