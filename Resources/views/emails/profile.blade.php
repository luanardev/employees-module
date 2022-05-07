@component('mail::message')
<h2>Dear {{$employee->name()}}</h2>

<p>Please be advised that your Profile information has been updated.</p>
<p>Login to your <a href="{{route('login')}}">Staff Account</a> to see the changes. </p>


{{ config('app.name') }}
@endcomponent
