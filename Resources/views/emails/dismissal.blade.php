@component('mail::message')
<h2>Dear {{$employee->name()}}</h2>

<p>Please be advised that your appointment as {{$employe->employment->getDesignation()}} is terminated effective today.</p>

{{ config('app.name') }}
@endcomponent
