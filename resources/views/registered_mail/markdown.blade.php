@component('mail::message')
# Welcome {{$user->first_name}}

You have successfully registered in Vehicle Management System.
We see your interest is in
<?php if($user->interest==1) echo "<strong>car.</strong><br>";
else echo "<strong>bike.<strong><br>"; ?>
We hope to contact you soon for more information.

@component('mail::button', ['url' => ''])
See Vehicles
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
