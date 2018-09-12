@component('mail::message')
# Wizard Technical Services

Hello {{ $user->name }},

Thanks for registering!


Thanks,<br>
{{ config('app.name') }}
@endcomponent
