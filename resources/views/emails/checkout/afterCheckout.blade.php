@component('mail::message')
# Register Camp {{ $checkout->Camp->title }}

Hi, {{ $checkout->User->name }}

Thanks for register on <b>{{ $checkout->Camp->title }}</b>, Please Fill The Payment Instruction by click button below. 

@component('mail::button', ['url' => route('dashboard', $checkout->id )])
My DAshboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
