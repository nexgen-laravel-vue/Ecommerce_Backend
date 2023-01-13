<x-mail::message>
# Welcome to first generated mail
Dear {{$name }},
The demo  body of your message.

<x-mail::button :url="'http://127.0.0.1:5176/reset-password?id=12'">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
