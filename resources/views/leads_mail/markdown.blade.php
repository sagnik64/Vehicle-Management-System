@component('mail::message')
# Hello Admin {{$user1->first_name}}

You have a lead!

Lead information: <?php echo "<br>" ?>
Name: {{$user2->first_name}} {{$user2->last_name}} <?php echo "<br>" ?>
Phone: {{$user2->phone}} <?php echo "<br>" ?>
Address: {{$user2->address}} <?php echo "<br>" ?>
Email: {{$user2->email}} <?php echo "<br>" ?>


@component('mail::button', ['url' => ''])
Mail to {{$user2->first_name}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
