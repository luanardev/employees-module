@component('mail::message')
<h2>Dear {{$employment->staff->name()}}</h2>

<p>Please be advised that we have created a staff record for you in our system.</p>
<p>Below is the information pertaining your employment.</p>
<p>
    Employee ID : <strong>{{$employment->staff_id}}</strong> <br/>
    Employee Email: <strong>{{$employment->staff->emailAddress()}}</strong> <br/>
    Position: <strong>{{$employment->getPosition()}}</strong> <br/>
    Scale: <strong>{{$employment->getScale()}}</strong><br/>
    Appointment: <strong>{{$employment->getType()}}</strong> <br/>
    Department: <strong>{{$employment->getDepartment()}}</strong> <br/>
    Campus: <strong>{{$employment->getCampus()}}</strong>
</p>

{{ config('app.name') }}
@endcomponent
