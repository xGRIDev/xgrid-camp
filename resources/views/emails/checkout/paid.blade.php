@component('mail::message')
# Your Transaction has been Confirmed

Hi, {{ $checkout->User}}
      <br>  Your Transaction has been Confirmed, now you can enjoy the benefits <b>{{ $checkout->Camp->title }}</b> 

@component('mail::button', ['url' => route('user.dashboard')])
My Dashboard    
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
