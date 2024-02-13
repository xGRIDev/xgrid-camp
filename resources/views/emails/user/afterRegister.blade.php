@component('mail::message')
# Welcome

Hi, {{ $user->name }}
Welcome, to xGRID-CAMP, Your Account Has been Created Successfully.

@component('mail::button', ['url' => route('login')])
Login Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
