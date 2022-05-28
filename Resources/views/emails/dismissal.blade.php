@component('mail::message')
<h2>Dear {{$staff->name()}}</h2>

<p>Please be advised that your appointment as {{$staff->employment->getPosition()}} is terminated effective today.</p>

{{ config('app.name') }}
@endcomponent
