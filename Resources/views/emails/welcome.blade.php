@component('mail::message')
<h2>Dear {{$staff->name()}}</h2>

<p>Welcome to {{ config('app.name') }}! </p>
<p>We are pleased to have you working with us, and to help achieve our mission.</p>
<p>Please read all {{ config('app.name') }}'s Policies to get yourself acquinted.</p>

{{ config('app.name') }}
@endcomponent
