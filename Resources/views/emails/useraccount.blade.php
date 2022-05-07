@component('mail::message')
<h2>Dear {{$employee->name()}}</h2>

<p>Please be advised that we have created a Staff Account for you.</p>
<p>Below are your login details. Please keep them safe.</p>
<p>
    Email Address: <strong>{{$employee->emailaddress()}}</strong><br/>
    Password : <strong>{{$password}}</strong>
</p>

<p>Visit <a href="{{route('login')}}">{{ config('app.name') }} Website</a> to login to your Staff Account.</p>

{{ config('app.name') }}
@endcomponent
