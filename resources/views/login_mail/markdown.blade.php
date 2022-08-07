@component('mail::message')
# Welcome {{$user->first_name}}

You have logged in successfully.

This mail was sent to {{$user->email}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
