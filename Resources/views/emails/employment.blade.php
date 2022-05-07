@component('mail::message')
<h2>Dear {{$employment->employee->name()}}</h2>

<p>Please be advised that we have created a staff record for you in our system.</p>
<p>Below is the information pertaining your employment.</p>
<p>
    Employee ID : <strong>{{$employment->employee_id}}</strong> <br/>
    Employee Email: <strong>{{$employment->employee->emailAddress()}}</strong> <br/>
    Designation: <strong>{{$employment->getDesignation()}}</strong> <br/>
    Grade Scale: <strong>{{$employment->gradeScale()}}</strong><br/>
    Appointment: <strong>{{$employment->getType()}}</strong> <br/>
    Department: <strong>{{$employment->getDepartment()}}</strong> <br/>
    Campus: <strong>{{$employment->getCampus()}}</strong>
</p>

{{ config('app.name') }}
@endcomponent
