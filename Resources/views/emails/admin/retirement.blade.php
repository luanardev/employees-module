@component('mail::message')
<h2>Dear Admin</h2>

<p>Please be advised that {{ $employee->fullname() }} is now RETIRED from the post of {{$employee->employment->getDesignation()}}</p>
<p>Below is the information pertaining the retirement</p>
<p>
    Starting Date: <strong>{{$employee->employment->startDate()}}</strong> <br/>
    Period of Service: <strong>{{$employee->employment->elapsedPeriod()}}</strong> <br/>
    Grade Scale: <strong>{{$employment->gradeScale()}}</strong><br/>
    Current Age: <strong>{{$employee->age()}}</strong> <br/>
</p>

{{ config('app.name') }}
@endcomponent
